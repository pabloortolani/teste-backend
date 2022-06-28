<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    use HasFactory;

    CONST EMPRESTADO = 'Emprestado';
    CONST DISPONIVEL = 'Disponível';

    protected $table = 'loan_status';

    protected $fillable = [
        'name'
    ];
}
