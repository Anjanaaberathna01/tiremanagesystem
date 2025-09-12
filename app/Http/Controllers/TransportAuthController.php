<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.transportlogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // true if checked

        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            $role = Auth::user()->role ?? null;
            if ($role === 'transport_officer' || $role === 'transport_manager') {
                return redirect()->intended(route('transport.viewtransport'));
            }

            // Not authorized for this area
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('transport.login')->withErrors(['username' => 'Access denied.']);
        }

        return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

}