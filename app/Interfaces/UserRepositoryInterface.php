<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function find(int $id): ?User;
    public function update(User $user, array $data): bool;
    public function delete(User $user): bool;
}
