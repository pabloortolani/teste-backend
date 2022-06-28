<?php

namespace App\Http\Requests;

use App\Models\Loan;
use Illuminate\Foundation\Http\FormRequest;

class LoanStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'required|string|in:'.Loan::ATRASADO.','.Loan::DEVOLVIDO.",".
                strtolower(Loan::ATRASADO).",".strtolower(Loan::DEVOLVIDO)
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Obrigatório informar o status.',
            'status.string' => 'Status inválido.',
            'status.in' => 'Status inválido.'
        ];
    }
}
