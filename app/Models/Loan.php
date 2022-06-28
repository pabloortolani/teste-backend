<?php

namespace App\Models;

use App\Events\UpdateLoanStatusBookEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    CONST ATRASADO = 'Atrasado';
    CONST DEVOLVIDO = 'Devolvido';
    CONST ATIVO = 'Ativo';
    CONST STATUS_DISPONIBLE = [self::DEVOLVIDO];

    protected $fillable = [
        'user_id',
        'book_id',
        'devolution_date',
        'status'
    ];

    protected $dispatchesEvents = [
        'saved' => UpdateLoanStatusBookEvent::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
