<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                /** @var  $user */
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    'message' => 'success',
                    'token' => $token,
                    'user' => $user
                ]);
            }
        }catch(\Exception $ex){
            return response([
                'message' => $ex->getMessage()
            ],400);
        }


        return response([
            'message' => 'Invalid username or password'
        ], 401);
    }

    public function  user(){
        return Auth::user();
    }
}

