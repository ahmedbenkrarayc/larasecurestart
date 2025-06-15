<?php

namespace App\Repositories\Interfaces;
use App\Models\User;

interface IAuthRepository{
    public function createUser(array $data);
    public function findUserByEmail(string $email);
    public function updateResetToken(User $user, string $resetToken, string $expiresAt);
    public function updatePassword(User $user, string $newPassword);
}