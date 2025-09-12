<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.officerlogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // prevent session fixation
            $request->session()->regenerate();

            $role = Auth::user()->role ?? null;
            if ($role === 'supervisor' || $role === 'manager') {
                return redirect()->intended(route('tirerequest.approval'));
            }

            // not authorised for this guard/area
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('officer.login')->withErrors(['username' => 'Access denied.']);
        }

        return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }
}