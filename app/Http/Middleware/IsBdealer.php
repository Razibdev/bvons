<?php

namespace App\Http\Middleware;

use Closure;

class IsBdealer
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
        if(auth()->user()->b_dealer && auth()->user()->b_dealer->bdealer_type_id !== null && auth()->user()->b_dealer->status === "active") return $next($request);
        return response()->json(["User is not Bdealer"], 422);
    }
}
