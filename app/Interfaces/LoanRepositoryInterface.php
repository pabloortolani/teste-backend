<?php

namespace App\Interfaces;

use App\Models\Loan;

interface LoanRepositoryInterface
{
    public function create(array $data): Loan;
    public function find(int $id): ?Loan;
    public function updateStatus(Loan $loan, string $status): bool;
}
