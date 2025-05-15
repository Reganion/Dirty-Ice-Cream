<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        return redirect('/customer/login'); // redirect to customer login
    }
}
