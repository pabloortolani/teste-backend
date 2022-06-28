<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Helpers\StatusReturn;
use App\Models\{Book, Loan, User};
use App\Interfaces\{BookRepositoryInterface, LoanRepositoryInterface, UserRepositoryInterface};
use Exception;

class LoanService
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private UserRepositoryInterface $userRepository,
        private LoanRepositoryInterface $loanRepository
    ) {}

    /**
     * @throws Exception
     */
    public function create(array $data): array
    {
        try {
            $user = $this->getUser($data['user_id']);
            $book = $this->getBook($data['book_id']);

            if (! $this->canLoanBook($book)) {
                throw new Exception("Livro indisponível para empréstrimo!", StatusReturn::ERROR);
            }

            $data = array_merge(
                $data,
                [
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'devolution_date' => DateHelper::convertDateBRtoUS($data['devolution_date']),
                    'status' => Loan::ATIVO
                ]
            );

            $loan = $this->loanRepository->create($data);

            return [
                'id' => $loan->id,
                'user' => $loan->user->name,
                'book' => $loan->book->name,
                'devolution_date' => DateHelper::convertDateUStoBR($loan->devolution_date),
                'status' => $loan->status
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function changeStatus(array $data, int $id): array
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            throw new Exception("Empréstimo não encontrado!", StatusReturn::NOT_FOUND);
        }

        $this->loanRepository->updateStatus($loan, $data['status']);

        $loan = $loan->refresh();

        return [
            'id' => $loan->id,
            'user' => $loan->user->name,
            'book' => $loan->book->name,
            'devolution_date' => DateHelper::convertDateUStoBR($loan->devolution_date),
            'status' => $loan->status
        ];
    }

    /**
     * @throws Exception
     */
    private function getUser(int $id): ?User
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            throw new Exception("Usuário inválido!", StatusReturn::ERROR);
        }

        return $user;
    }

    /**
     * @throws Exception
     */
    private function getBook(int $id): ?Book
    {
        $book = $this->bookRepository->find($id);
        if (empty($book)) {
            throw new Exception("Livro inválido!", StatusReturn::ERROR);
        }

        return $book;
    }

    private function canLoanBook(Book $book): bool
    {
        if (in_array($book->loanStatus->name, Book::STATUS_AVAILABLE_LOAN)) {
            return true;
        }

        return false;
    }
}
