<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SufficientCoins
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $registrationFee = rand(100000, 125000); // Random registration fee in Coins

        if ($request->user()->coins >= $registrationFee) {
            // Sufficient Coins, proceed with registration
            $user = $request->user();
            $user->coins -= $registrationFee;
            $user->save();
        return $next($request);
    }

    return redirect()->route('purchase.coins')->with('error', 'Insufficient Coins. Please purchase more Coins to register.');
    }
}
