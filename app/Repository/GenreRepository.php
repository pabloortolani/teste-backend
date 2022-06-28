<?php

namespace App\Repository;

use App\Interfaces\GenreRepositoryInterface;
use App\Interfaces\LoanStatusRepositoryInterface;
use App\Models\Genre;

class GenreRepository implements GenreRepositoryInterface
{
    public function __construct(private Genre $model) {}

    public function find(int $id): ?Genre
    {
        return $this->model->find($id);
    }

    public function findByName(string $name): ?Genre
    {
        return $this->model->where('name', $name)->first();
    }
}
