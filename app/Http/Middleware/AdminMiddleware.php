<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $redirectTo = '/admin/login';
    
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if (Auth::user()->role === 'admin') 
            {
                return $next($request);
            } 
            else {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'You do not have admin access.');
            }
        } else {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'You do not have admin access.');
        }
    }
}