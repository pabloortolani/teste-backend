<?php

namespace App\Interfaces;

use App\Models\Genre;

interface GenreRepositoryInterface
{
    public function find(int $id): ?Genre;
    public function findByName(string $name): ?Genre;
}
