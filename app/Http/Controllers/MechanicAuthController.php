<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.mechaniclogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // true when checkbox checked

        if (Auth::attempt($credentials, $remember)) {
            // regenerate session to prevent fixation
            $request->session()->regenerate();

            if (Auth::user()->role === 'mechanic') {
                return redirect()->intended(route('transport.evaluation'));
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('mechanic.login')->withErrors(['username' => 'Access denied.']);
        }

        return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }
}