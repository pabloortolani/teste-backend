<?php

namespace App\Interfaces;

use App\Models\Book;

interface BookRepositoryInterface
{
    public function create(array $data): Book;
    public function find(int $id): ?Book;
    public function update(Book $user, array $data): bool;
    public function delete(Book $user): bool;
}
