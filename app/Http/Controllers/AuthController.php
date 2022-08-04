<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
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
                return response()->json([
                    'message' => 'success',
                    'token' => $token,
                    'user' => $user
                ]);
            }
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage()
            ],400);
        }


        return response()->json([
            'message' => 'Invalid username or password'
        ], 401);
    }

    public function  user(){
        return Auth::user();
    }


    public function register(RegisterRequest $request){
        try{
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => \Hash::make($request->first_name)
            ]);
        }catch(\Throwable $ex){
            return response()->json([
                'message' => $ex->getMessage()
            ],400);
        }

        return response()->json([
            'message' => 'The record was created successfully',
            'user' => $user
        ],200);
    }
}

