<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //
    public function Login(LoginRequest $request){
        //
        $user = User::where('email', $request['input'])->orWhere('name', $request['input'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken("Login Token");

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken,
            ],
        ], 200);
    }
    public function register(RegisterRequest $request){
        //
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken("Register Token");

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token->plainTextToken,
                ],
            ], 201);

        }catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }

}
