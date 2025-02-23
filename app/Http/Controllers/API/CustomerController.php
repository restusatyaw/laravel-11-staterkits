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
    /**
     * @SWG\Post(
     *     path="/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function register(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
    
            $data = $request->only([
                'name',
                'email',
                'password',
                'confirm_password'
            ]);
            $data['is_mobile_app'] = 1;
            $data['role_id'] = Role::where('name', 'Customer')->first()->id;
            $user = $this->userServices->create($data);

            return response()->json([
                'message' => 'register successfully',
                'status' => true,
            ], 201);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'register fail on : '.' '. $th->getMessage(),
                'status' => false,
            ], 500);
        }

        
    }

    function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $findUser = $this->userServices->getFilteredData(['email' => $credentials['email']])->first();


            if($findUser && $findUser->is_mobile_app == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'akun tidak ditemukan'
                ], 500);
            }

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
