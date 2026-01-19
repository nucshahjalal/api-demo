<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //api show data 
    public function index(Request $request)
    {
       // $token = $request->bearerToken();
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                "message" => "Unauthorized: API token not found"
            ], 401);
        }

        $users = User::all();

        if ($users->count() > 0) {
            return response()->json([
                "users" => $users,
                "message" => "Users fetched successfully"
            ], 200);
        }

        return response()->json([
            "message" => "No users found"
        ], 404);
    }

    //receive api data show route web.php file
    public function userlist(Request $request){
       
        return view('api.index');
    }

    //receive another api data show route web.php file
    public function schoolApi(){
       
        return view('api.school_api');
    }

    //api data handover another user route api.php file
    public function apiUserList(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                "message" => "Unauthorized: API token not found"
            ], 401);
        }  
        $users = User::all(); 
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],
            [
                'email.unique' => 'This email address is already registered.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        $user->api_token = $token;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user'    => $user,
            'token'   => $token
        ], 201);
    }
  
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401);
        }

        if (empty($user->api_token)) {
            return response()->json([
                'message' => 'API token not found. Please register first.'
            ], 403);
        }

        $token = $user->api_token;

        return response()->json([
            'user' => $user,
            'message' => 'User login successfully',
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
