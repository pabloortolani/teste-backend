<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model) {}

    public function create(array $data): User
    {
        return $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }


    public function update(User $user, array $data): bool
    {
        return $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
