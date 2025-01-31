<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponses;

    /**
     * Register a new user.
     *
     * @param RegisterUserRequest $request The request object containing user registration data.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the registration.
     */
    public function register(RegisterUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $this->ok('User registered successfully', $user);
    }


    /**
     * Handle the login request.
     *
     * @param  \App\Http\Requests\LoginUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * This method attempts to authenticate the user using the provided credentials.
     * If authentication is successful, it returns a JSON response with a bearer token.
     * If authentication fails, it returns a JSON response with an unauthorized error.
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', [], 401);
        }

        $user = User::where('email', $request->email)->first();

        $user->tokens()->where('created_at', '<', now()->subMinutes(config('sanctum.expiration')))->delete();

        return $this->ok('User logged in successfully', [
            'token' => $user->createToken('authToken')->plainTextToken,
            'token_type' => 'bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('User logged out successfully');
    }
}
