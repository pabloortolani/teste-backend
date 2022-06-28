<?php

namespace App\Services;

use App\Helpers\StatusReturn;
use App\Models\{LoanStatus, Book};
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
    public function create(array $data): Book
    {
        try {
            $loanStatus = $this->getLoadStatus($data['loan_status']);

            if (!empty($data['genre_id'])) {
                $this->validateGenre($data['genre_id']);
            }

            return $this->bookRepository->create(array_merge($data, ['loan_status_id' => $loanStatus->id]));
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

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
        if (!empty($data['genre_id'])) {
            $this->validateGenre($data['genre_id']);
        }

        $this->bookRepository->update($book, array_merge($data, ['loan_status_id' => $loanStatus->id]));

        $book = $book->refresh();

        return [
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
            'loan_status' => $book->loanStatus->name,
            'genre' => $book->genre->name ?? null
        ];
    }

    public function destroy(int $id): bool
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            throw new Exception("Livro não encontrado!", StatusReturn::NOT_FOUND);
        }

        return $this->bookRepository->delete($book);
    }

    private function getLoadStatus(string $name): ?LoanStatus
    {
        $loanStatus = $this->loanStatusRepository->findByName($name);
        if (empty($loanStatus)) {
            throw new Exception("Status de empréstimo inválido!", StatusReturn::ERROR);
        }

        return $loanStatus;
    }

    private function validateGenre(int $id): void
    {
        $genre = $this->genreRepository->find($id);
        if (empty($genre)) {
            throw new Exception("Gênero inválido!", StatusReturn::ERROR);
        }
    }
}
