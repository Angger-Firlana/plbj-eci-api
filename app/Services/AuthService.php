<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
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