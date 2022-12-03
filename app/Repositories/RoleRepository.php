<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return Role::query()
            ->with(['created_by:id,name'])
            ->search($search)
            ->order($sort)
            ->paginate(10);
    }

    public function delete(Role $role): void
    {
        DB::beginTransaction();
        try {
            $role->permissions()->detach();
            $role->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function store(array $data, array $permissions): Role
    {
        DB::beginTransaction();
        try {
            $role = Role::query()->create($data);
            $role->permissions()->attach($permissions);
            DB::commit();
            return $role;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Role $role, array $data, array $permissions): Role
    {
        DB::beginTransaction();
        try {
            $role->update($data);
            $role->permissions()->sync($permissions);
            DB::commit();
            return $role;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show(Role $role): Role
    {
        $role->load(['created_by:id,name', 'updated_by:id,name', 'permissions:id,name']);
        return $role;
    }

    public function getPermissions() : Collection
    {
        return Permission::query()->select('id', 'name')->orderBy('name')->get();
    }

}
