<?php

namespace App\Interfaces;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator;

    public function delete(Role $role): void;

    public function store(array $data, array $permissions): Role;

    public function update(Role $role, array $data, array $permissions): Role;

    public function show(Role $role): Role;

    public function getPermissions(): Collection;
}
