<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): User;
    public function login(User $user): User;
    public function logout(User $user): void;
}
