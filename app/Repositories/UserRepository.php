<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(User $user): User
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $user->token = $tokenResult->accessToken;
        return $user;
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return User::query()
            ->search($search)
            ->order($sort)
            ->filter($filter)
            ->isUser()
            ->paginate(10);
    }

    public function update(User $user, array $data): User
    {
        $columns = ['name', 'email', 'is_activate'];
        $updatedData = [
            "updated_user" => $data['updated_user']
        ];
        if (isset($data['password'])) {
            $updatedData['password'] = Hash::make($data['password']);
        }
        foreach ($columns as $column) {
            if (isset($data[$column])) {
                $updatedData[$column] = $data[$column];
            }
        }
        $user->update($updatedData);
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
