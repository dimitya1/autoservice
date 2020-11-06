<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_admin === 0) {
            return redirect()
                ->route('home')
                ->withErrors(['not allowed' => 'Вы не админ.']);
        }
        return $next($request);
    }
}
