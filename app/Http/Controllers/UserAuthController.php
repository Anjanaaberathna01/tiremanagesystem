<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.userlogin');
    }

   public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->filled('remember'); // true if checkbox checked

        // Attempt authentication with username/password and remember flag
        if (Auth::attempt($credentials, $remember)) {
            // Prevent session fixation
            $request->session()->regenerate();

            $user = Auth::user();

            // Allow only driver or user roles to access tire request
            if (in_array($user->role, ['driver', 'user'])) {
                return redirect()->intended('tirerequest')
                                 ->with('success', 'Welcome to the Tire Request System!');
            }

            // If role not allowed, log out and return error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['login' => 'You are not authorized to access this area.']);
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }
}