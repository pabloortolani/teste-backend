<?php

namespace App\Interfaces;

use App\Models\LoanStatus;

interface LoanStatusRepositoryInterface
{
    public function findByName(string $name): ?LoanStatus;
}
