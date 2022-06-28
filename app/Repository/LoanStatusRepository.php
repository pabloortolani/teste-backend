<?php

namespace App\Repository;

use App\Interfaces\LoanStatusRepositoryInterface;
use App\Models\LoanStatus;

class LoanStatusRepository implements LoanStatusRepositoryInterface
{
    public function __construct(private LoanStatus $model) {}

    public function findByName(string $name): ?LoanStatus
    {
        return $this->model->where('name', $name)->first();
    }
}
