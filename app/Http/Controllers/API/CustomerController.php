<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerController extends Controller
{

    private $userServices;

    function __construct(UserService $userService)
    {
        $this->userServices = $userService;
    }

    function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $findUser = $this->userServices->getFilteredData(['email' => $credentials['email']])->first();

            $user = auth()->user();

            // (optional) Attach the role to the token.
            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }
    }

    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    // User logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
