<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
public function register(Request $request)
{   
    $filds = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'name' => $filds['name'],
        'email' => $filds['email'],
        'password' => bcrypt($filds['password'])
    ]);

    return response([
        'msg' => 'register successfully',
        'user' => $user,
        'token' => $user->createToken('secret')->plainTextToken
    ], 200);
}

public function login(Request $request)
{   
    $filds = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    if(!Auth::attempt($filds)){
        return response([
            'message' => 'Invalid credentials.'
        ], 403);
    }

    return response([
        'msg' => 'login success',
        'user' => auth()->user(),
        'token' => auth()->user()->createToken('secret')->plainTextToken
    ], 200);
}    

public function logout(Request $request)
{   
    auth()->user()->tokens()->delete();
    return response([
        'message' => 'logout'
    ], 200);
}

public function user()
{
    return response([
        'user' => auth()->user()
    ], 200);
}


}
