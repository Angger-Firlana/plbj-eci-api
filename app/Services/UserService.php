<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data):User{
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pin' => $data['pin'],
            'role_id' => $data['role_id'],
            'profile_photo' => $data['profile_photo_path'] ?? null
        ]);
        
        return $user;
    }
}