<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthentication {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) {
        $token = $request->cookie('token');
        $result = JWTToken::ReadToken($token);

        if ($result == "Unauthorized") {
            return redirect('/userLoginPage');
        } else {
            $request->headers->set('email', $result->userEmail);
            $request->headers->set('id', $result->id);
            return $next($request);
            // return "token acha";
        }

    }
}
