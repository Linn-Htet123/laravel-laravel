<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Student;

class ApiAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->bearerToken()){
            return response()->json(['message'=>'need api token'],401);
        }
        $token = $request->bearerToken();
        $student = Student::where("api_token",$token)->first();
        if (is_null($student)){
            return response()->json(['message'=>'wrong api token name'],401);
        }
        session(['auth'=>$student]);
        return $next($request);
    }
}
