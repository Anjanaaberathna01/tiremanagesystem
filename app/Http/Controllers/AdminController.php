<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login.adminlogin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials['role'] = 'admin';

        $remember = $request->filled('remember'); // true if checked

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/masterdata.tiredashboard')
                            ->with('success', 'Welcome to the Admin Dashboard!');
        }

        return back()->withErrors(['login' => 'Invalid credentials or not an admin.']);
    }
}
