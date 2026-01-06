<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        // Implementation will go here
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => $data['is_active'],
            'pin' => $data['pin'],
            'profile_photo' => $data['profile_photo_path'] ?? null,
            'role_id' => $data['role_id']
        ]);

        if(!$user) {
            throw new \Exception('Failed to create user');
        }
        
        return $user;
    }
}