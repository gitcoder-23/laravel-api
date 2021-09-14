<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// required
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
                'token' => $token
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
