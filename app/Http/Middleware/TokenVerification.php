<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;

class TokenVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');

        if (! $token) {
            session()->flash('error', ResponseHelper::Out(false, 'unauthorized', 401));
            return redirect()->route('login');
        }

        try {
            $result = JWTToken::verifyToken($token);
        } catch (\Exception $e) {
            session()->flash('error', ResponseHelper::Out(false, 'unauthorized', 401));
            return redirect()->route('login');
        }

        if (! is_object($result) || empty($result->email)) {
            session()->flash('error', ResponseHelper::Out(false, 'unauthorized', 401));
            return redirect()->route('login');
        }

        // Set user details in headers
        $request->headers->set('email', $result->email);
        $request->headers->set('id', $result->id ?? null);
        $request->headers->set('role', $result->role ?? null);

        return $next($request);
    }
}
