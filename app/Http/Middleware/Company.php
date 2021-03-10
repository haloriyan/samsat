<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $myData = Auth::guard('company')->user();
        if ($myData == "") {
            return redirect()->route('app.loginPage');
        }
        if ($myData->is_active == 0) {
            Auth::guard('company')->logout();
            return redirect()->route('app.loginPage')->withErrors(['Akun Anda belum aktif']);
        }
        return $next($request);
    }
}
