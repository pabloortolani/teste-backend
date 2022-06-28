<?php

namespace App\Http\Requests;

use App\Models\LoanStatus;
use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
            'devolution_date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Obrigatório informar o ID do usuário que vai fazer o empréstimo.',
            'user_id.integer' => 'ID do usuário inválido.',
            'book_id.required' => 'Obrigatório informar o ID do livro que será emprestado o livro.',
            'book_id.integer' => 'ID do livro inválido.',
            'devolution_date.required' => 'Obrigatório informar a data de devolução do emprestado.',
            'devolution_date.date' => 'Data de devolução do empréstimo inválida.',
        ];
    }
}
