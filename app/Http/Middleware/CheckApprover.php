<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Approving;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApprover
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = auth()->user()->email;
        $approvingUser = Approving::where('email', $email)->where('etat', 1)->first();

        if ($approvingUser) {
            return $next($request);
        }

        return response()->view('erreur.error403', [], 403);
    }
}
