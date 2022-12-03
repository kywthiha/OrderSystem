<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $user->delete();
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
            ]);
            $user->roles()->attach($roles);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function show(User $user): User
    {
        $user->load(['created_by:id,name', 'updated_by:id,name', 'category:id,name', 'subCategory:id,name']);
        return $user;
    }
}
