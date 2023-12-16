<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        // $request->session()->regenerate();

        $user = User::where('email', $request->email)->first();
        
        $token = $user->createToken('apiToken')->accessToken;

        return $this->successResponse([
            'user'=>$user,
            'token'=> $token,
        ], 'logged in successfully', 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): Response
    {
        auth()->user()->tokens()->delete();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return response()->noContent();
    }
}
