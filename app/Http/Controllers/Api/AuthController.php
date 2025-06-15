<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $response = $this->authService->register($data);

        return response()->json($response);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $response = $this->authService->login($credentials);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 401);
        }

        return $this->respondWithTokens($response['token'], $response['refresh_token']);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        return response()->json($response)
            ->cookie('token', '', -1)
            ->cookie('refresh_token', '', -1);
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');
        
        if (!$refreshToken) {
            return response()->json(['error' => 'Refresh token not found'], 401);
        }

        $response = $this->authService->refresh($refreshToken);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 401);
        }

        return $this->respondWithTokens($response['token'], $response['refresh_token']);
    }

    protected function respondWithTokens($token, $refreshToken)
    {
        return response()->json([
            'message' => 'Authenticated',
            'user' => auth()->user(),
        ])
        ->cookie('token', $token, 60, '/', '', false, true, false, 'Strict')
        ->cookie('refresh_token', $refreshToken, 20160, '/', '', false, true, false, 'Strict');
    }

    public function user(Request $request)
    {
        $user = auth()->user();
    
        return response()->json($user);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $request->validated();
        $response = $this->authService->forgotPassword($request->email, $request->url);

        return response()->json($response);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $request->validated();

        $response = $this->authService->resetPassword(
            $request->email,
            $request->reset_token,
            $request->password
        );

        return response()->json($response);
    }
}
