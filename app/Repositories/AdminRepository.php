<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;

class AdminRepository implements AdminRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return User::query()
            ->search($search)
            ->order($sort)
            ->filter($filter)
            ->isAdmin()
            ->paginate(10);
    }

    public function delete(User $user): void
    {
        DB::beginTransaction();
        try {
            $user->roles()->detach();
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function store(array $data, array $roles): User
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => true,
                "created_user" => $data['created_user']
            ]);
            $user->roles()->attach($roles);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(User $user, array $data, array $roles): User
    {
        DB::beginTransaction();
        try {
            $updatedData = [
                'name' => $data['name'],
                'email' => $data['email'],
                "updated_user" => $data['updated_user']
            ];
            if (isset($data['password'])) {
                $updatedData['password'] = Hash::make($data['password']);
            }
            $user->update($updatedData);
            $user->roles()->sync($roles);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show(User $user): User
    {
        $user->load(['created_by:id,name', 'updated_by:id,name', 'roles.permissions']);
        return $user;
    }
}
