<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;
class AuthController extends Controller
{
    protected $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    //
    public function Login(LoginRequest $request){
        //
        try{
            $data = $this->authService->Login($request->validated());

            if($data['code'] !== 200) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login failed',
                    'error' => $data['message'] ?? 'Unknown error',
                ], $data['code']);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    $data
                ],
            ], 200);
        }catch(\Exception $e) {
            return response()->json(['message' => 'Login failed', 'error' => $e->getMessage()], 500);
        }
        
    }
    
    public function register(RegisterRequest $request){
        //
        try{
           $user = $this->authService->Register($request->validated());
           return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
            ],
        ], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }

}
