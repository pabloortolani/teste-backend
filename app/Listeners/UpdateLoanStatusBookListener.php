<?php

namespace App\Listeners;

use App\Models\Book;
use App\Models\Loan;
use App\Repository\LoanStatusRepository;

class UpdateLoanStatusBookListener
{
    public function handle($event)
    {
        $status = in_array($event->loan->status, Loan::STATUS_DISPONIBLE) ? Book::DISPONIVEL : Book::EMPRESTADO;

        $statusId = app(LoanStatusRepository::class)->findByName($status)->id;

        Book::where('id', $event->loan->book_id)->update([
            'loan_status_id' => $statusId
        ]);
    }
}
