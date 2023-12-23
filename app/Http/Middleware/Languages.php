<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Languages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('locale')) {
            App::setLocale(session('locale'));
        } else {
            App::setLocale('ar');
        }
        return $next($request);
    }
}
