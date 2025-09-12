<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSupervisorOrManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $redirectTo = '/officer/login';
    
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role ?? null;
            if ($role === 'supervisor' || $role === 'manager') {
                return $next($request);
            }
            else {
                Auth::logout();
                return redirect()->route('officer.login')->with('error', 'You do not have access to this resource.');
            }
        } else {
            Auth::logout();
            return redirect()->route('officer.login')->with('error', 'You do not have access to this resource.');
        }
            
    }

   
}