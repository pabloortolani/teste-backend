<?php

namespace App\Services;

use App\Helpers\StatusReturn;
use App\Models\{Genre, LoanStatus, Book};
use App\Interfaces\{BookRepositoryInterface, GenreRepositoryInterface, LoanStatusRepositoryInterface};
use Exception;

class BookService
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private LoanStatusRepositoryInterface $loanStatusRepository,
        private GenreRepositoryInterface $genreRepository
    ) {}

    /**
     * @throws Exception
     */
    public function create(array $data): array
    {
        try {
            $loanStatus = $this->getLoadStatus($data['loan_status']);
            $genre = !empty($data['genre']) ? $this->getGenre($data['genre']) : null;

            $book = $this->bookRepository->create(
                array_merge($data, ['loan_status_id' => $loanStatus->id], ['genre_id' => $genre?->id])
            );

            return [
                'id' => $book->id,
                'name' => $book->name,
                'author' => $book->author,
                'loan_status' => $book->loanStatus->name,
                'genre' => $book->genre->name ?? null
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function find(int $id): ?array
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            throw new Exception("Livro não encontrado!", StatusReturn::NOT_FOUND);
        }

        return [
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
            'loan_status' => $book->loanStatus->name,
            'genre' => $book->genre->name ?? null
        ];
    }

    /**
     * @throws Exception
     */
    public function update(array $data, int $id): array
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            throw new Exception("Livro não encontrado!", StatusReturn::NOT_FOUND);
        }

        $loanStatus = $this->getLoadStatus($data['loan_status']);
        $genre = !empty($data['genre']) ? $this->getGenre($data['genre']) : null;

        $this->bookRepository->update(
            $book,
            array_merge($data, ['loan_status_id' => $loanStatus->id], ['genre_id' => $genre?->id])
        );

        $book = $book->refresh();

        return [
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
            'loan_status' => $book->loanStatus->name,
            'genre' => $book->genre->name ?? null
        ];
    }

    /**
     * @throws Exception
     */
    public function destroy(int $id): bool
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            throw new Exception("Livro não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $this->bookRepository->delete($book);
    }

    /**
     * @throws Exception
     */
    private function getLoadStatus(string $name): ?LoanStatus
    {
        $loanStatus = $this->loanStatusRepository->findByName($name);
        if (empty($loanStatus)) {
            throw new Exception("Status de empréstimo inválido!", StatusReturn::ERROR);
        }

        return $loanStatus;
    }

    /**
     * @throws Exception
     */
    private function getGenre(string $name): ?Genre
    {
        $genre = $this->genreRepository->findByName($name);
        if (empty($genre)) {
            throw new Exception("Gênero inválido!", StatusReturn::ERROR);
        }

        return $genre;
    }
}
