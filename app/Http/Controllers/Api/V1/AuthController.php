<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterUserRequest;
use App\Http\Requests\Api\V1\LoginUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponses;


    #[OA\Post(
        path: "/api/v1/register",
        summary: "Register a new user",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "application/x-www-form-urlencoded",
                schema: new OA\Schema(
                    required: ["first_name", "last_name", "email", "password", "password_confirmation"],
                    properties: [
                        new OA\Property(property: 'name', description: "User name", type: "string"),
                        new OA\Property(property: 'email', description: "User email", type: "string"),
                        new OA\Property(property: 'password', description: "User password", type: "string"),
                        new OA\Property(property: 'password_confirmation', description: "User password confirmation", type: "string"),
                    ]
                )
            )
        ),
        tags: ["Authentication"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "User registered successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: 'message', type: "string"),
                        new OA\Property(property: 'data', type: "object", properties: [
                            new OA\Property(property: 'id', type: "integer"),
                            new OA\Property(property: 'name', type: "string"),
                            new OA\Property(property: 'email', type: "string"),
                            new OA\Property(property: 'created_at', type: "string"),
                            new OA\Property(property: 'updated_at', type: "string"),
                        ])
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "Invalid data",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: 'message', type: "string"),
                        new OA\Property(property: 'errors', type: "object")
                    ]
                )
            ),
        ]
    )]
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


    #[OA\Post(
        path: "/api/v1/login",
        summary: "Login a user",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: "application/x-www-form-urlencoded",
                schema: new OA\Schema(
                    required: ["email", "password"],
                    properties: [
                        new OA\Property(property: 'email', description: "User email", type: "string"),
                        new OA\Property(property: 'password', description: "User password", type: "string"),
                    ]
                )
            )
        ),
        tags: ["Authentication"],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "User logged in successfully",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: 'message', type: "string"),
                        new OA\Property(property: 'data', type: "object", properties: [
                            new OA\Property(property: 'token', type: "string"),
                            new OA\Property(property: 'token_type', type: "string"),
                        ])
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_UNAUTHORIZED,
                description: "Invalid credentials",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: 'message', type: "string"),
                        new OA\Property(property: 'errors', type: "object")
                    ]
                )
            ),
        ]
    )]
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
