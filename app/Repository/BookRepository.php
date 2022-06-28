<?php

namespace App\Repository;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function __construct(private Book $model) {}

    public function create(array $data): Book
    {
        return $this->model->create([
            'name' => $data['name'],
            'author' => $data['author'],
            'loan_status_id' => $data['loan_status_id'],
            'genre_id' => $data['genre_id'] ?? null
        ]);
    }

    public function find(int $id): ?Book
    {
        return $this->model->find($id);
    }

    public function update(Book $book, array $data): bool
    {
        return $book->update([
            'name' => $data['name'],
            'author' => $data['author'],
            'loan_status_id' => $data['loan_status_id'],
            'genre_id' => $data['genre_id'] ?? null
        ]);
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }
}
