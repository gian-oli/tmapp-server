<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    use ResponseTrait;

    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Handle user registration.
     *
     * Validates the request data, hashes the password, and stores the new user.
     * Returns a success response with user data or an error response if registration fails.
     *
     * @param  UserRequest  $request
     * 
     */
    public function register(UserRequest $request)
    {
        $result = $this->successResponse('User Successfully Registered.');
        try {
            $validated = $request->validated();
            $data = [
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $validated['role_id'],
            ];

            $result['data'] = $this->user_service->store($data);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
    }

    /**
     * Handle user login.
     *
     * Authenticates the user with the provided credentials. 
     * If authentication is successful, generates a new API token.
     * Returns a success response with the token or an error response if authentication fails.
     *
     * @param  UserLoginRequest  $request
     * 
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (!\Auth::attempt($credentials)) {
                $user = User::where('username', $credentials['username'])->first();
                
                if ($user) {
                    return $this->failedValidationResponse([
                        'status' => 'error',
                        'status_code' => 401,
                        'message' => 'Password is incorrect',
                    ]);
                }

                return $this->failedValidationResponse([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => 'Username or password is incorrect',
                ]);
            }

            $user = \Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return $this->returnResponse([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Login successful',
                'data' => ['token' => $token],
            ]);
        } catch (\Exception $e) {
            // Handle any unexpected errors during login
            return $this->errorResponse($e);
        }
    }

    /**
     * Handle user logout.
     *
     * Revokes the current API token for the authenticated user.
     * Returns a success response or an error response if the logout fails.
     *
     * @param  Request  $request
     * 
     */
    public function logout(Request $request)
    {
        try {
            // Get the authenticated user
            $user = $request->user();

            // Revoke the user's current token
            if ($user && $user->currentAccessToken()) {
                $user->currentAccessToken()->delete();
            }

            return $this->returnResponse([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Logged out successfully',
            ]);
        } catch (\Exception $e) {
            // Handle any errors during logout
            return $this->errorResponse($e);
        }
    }

    /**
     * Retrieve the authenticated user.
     *
     * Checks the validity of the API token provided in the Authorization header.
     * If valid, returns the authenticated user's information.
     * Returns an error response if the token is missing or invalid.
     *
     * @param  Request  $request
     * 
     */
    public function showAuthenticatedUser(Request $request)
    {
        try {
            // Retrieve the token from the Authorization header
            $token = $request->bearerToken();

            if (!$token) {
                return $this->failedValidationResponse([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => 'Token not provided'
                ]);
            }

            // Validate the token
            $personalAccessToken = PersonalAccessToken::findToken($token);

            if (!$personalAccessToken) {
                return $this->failedValidationResponse([
                    'status' => 'error',
                    'status_code' => 401,
                    'message' => 'Invalid token'
                ]);
            }

            // Retrieve the authenticated user
            $user = $personalAccessToken->tokenable;

            return $this->returnResponse([
                'status' => 'success',
                'status_code' => 200,
                'data' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            // Handle any errors while retrieving the authenticated user
            return $this->errorResponse($e);
        }
    }
}
