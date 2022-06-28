<?php

namespace App\Repository;

use App\Interfaces\LoanRepositoryInterface;
use App\Models\Loan;

class LoanRepository implements LoanRepositoryInterface
{
    public function __construct(private Loan $model) {}

    public function create(array $data): Loan
    {
        return $this->model->create([
            'user_id' => $data['user_id'],
            'book_id' => $data['book_id'],
            'devolution_date' => $data['devolution_date'],
            'status' => $data['status']
        ]);
    }

    public function find(int $id): ?Loan
    {
        return $this->model->find($id);
    }

    public function updateStatus(Loan $loan, string $status): bool
    {
        return $loan->update(['status' => $status]);
    }
}
