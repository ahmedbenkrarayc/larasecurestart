<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IAuthRepository;
use App\Models\User;

class AuthRepository implements IAuthRepository
{
    public function createUser(array $data){
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);
    }

    
    public function findUserByEmail(string $email){
        return User::where('email', $email)->first();
    }

    public function updateResetToken(User $user, string $resetToken, string $expiresAt){
        $user->reset_token = $resetToken;
        $user->reset_token_expires_at = $expiresAt;
        return $user->save();
    }

    public function updatePassword(User $user, string $newPassword){
        $user->password = $newPassword;
        return $user->save();
    }
}
