<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AdminRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator;

    public function delete(User $user): void;

    public function store(array $data): User;

    public function update(User $user, array $data): User;

    public function show(User $user): User;
}
