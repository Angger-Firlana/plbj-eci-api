<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
class AuthService
{
    public function Login(array $data):array{
        $user = User::where('email', $data['input'])->first()
            ?? User::where('name', $data['input'])->first();

        $user->tokens()->delete();

        if(!$user || !Hash::check($data['password'], $user->password)) {
            return [
                'code' => 401,
                'message' => 'Invalid credentials'
            ];
        }

        return [
            'code' => 200,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_active' => $user->is_active,
                'pin' => $user->pin,
                'profile_photo' => $user->profile_photo,
                'role_id' => $user->role_id,
            ],
            'token' => $user->createToken("Login Token")->plainTextToken
        ];
    }
    public function Register(array $data): User
    {
        $userService = new UserService();
        $user = $userService->createUser($data);

        if(!$user) {
            throw new \Exception('Failed to create user');
        }
        
        return $user;
    }
}