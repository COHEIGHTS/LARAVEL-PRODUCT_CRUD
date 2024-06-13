<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthorizeProduct
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authorized (admin or user)
        if (!auth()->user()->hasAnyRole(['admin', 'user'])) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
