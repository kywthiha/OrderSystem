<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function register(array $data): User;
    public function login(User $user): User;
    public function logout(User $user): void;
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator;

    public function update(User $user, array $data): User;
    public function delete(User $user): void;
}
