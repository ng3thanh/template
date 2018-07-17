<?php
namespace App\Http\Middleware;
use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::guest() || !(Sentinel::inRole('administrator') || Sentinel::inRole('moderator'))) {
            return redirect()->route('auth.login.form');
        }
        return $next($request);
    }
}