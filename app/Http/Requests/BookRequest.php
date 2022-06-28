<?php

namespace App\Http\Requests;

use App\Models\LoanStatus;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'author' => 'required|string',
            'loan_status' => 'required|string|in:'.LoanStatus::EMPRESTADO.','.LoanStatus::DISPONIVEL.",".
                strtolower(LoanStatus::EMPRESTADO).",".strtolower(LoanStatus::DISPONIVEL),
            'genre_id' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Obrigatório informar o nome do livro.',
            'name.string' => 'Nome do livro inválido.',
            'author.required' => 'Obrigatório informar o nome do autor.',
            'author.string' => 'Nome do autor inválido.',
            'loan_status.required' => 'Obrigatório informar o status do emprestimo.',
            'loan_status.string' => 'Status do emprestimo inválido.',
            'loan_status.in' => 'Status do emprestimo inválido.',
            'genre_id.integer' => 'Gênero inválido.'
        ];
    }
}
