<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Book extends Model
{
    use HasFactory, SoftDeletes;

    CONST DISPONIVEL = 'Disponível';
    CONST EMPRESTADO = 'Emprestado';
    CONST STATUS_AVAILABLE_LOAN = [self::DISPONIVEL];

    protected $fillable = [
        'name',
        'author',
        'loan_status_id',
        'genre_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function loanStatus()
    {
        return $this->belongsTo(LoanStatus::class, 'loan_status_id', 'id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
}
