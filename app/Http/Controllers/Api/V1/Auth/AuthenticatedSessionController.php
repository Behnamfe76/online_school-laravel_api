<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
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
            'user'=> new UserResource($user),
            'token'=> $token,
        ], 'logged in successfully', 200);
    }



    /**
     * Destroy an authenticated session.
     */
    public function isLogin(){
        $user = auth()->user();

        return $this->successResponse((new UserResource($user)), 'user authorized', 200);
    }


    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return $this->successResponse(null, 'logged out successfully', 200);
    }
}
