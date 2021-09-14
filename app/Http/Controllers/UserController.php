<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// required
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public $loginAfterSignUp = true;
    // Login
    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token,
                'token_type' => 'bearer',
                // 'expires_in' => auth()->factory()->getTTL() * 60
            ];
        
             return response($response, 201);
    }

    // Register
    function register(Request $request)
    {
        $rules = [
            'name' => 'unique:users|required|min:3',
            'email'    => 'unique:users|required',
            'password' => 'required',
        ];

        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'api_token' => Str::random(60),]);

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ];
    
         return response($response, 201);

    }

    // all user
    function users() 
    {
        return User::all();
    }

    // single user
    function singleUser($id=null) 
    {
        return User::find($id);
    }
}
