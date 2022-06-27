<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$request->user
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Obrigatório informar o nome do usuário.',
            'name.string' => 'Nome do usuário inválido.',
            'email.required' => 'Obrigatório informar o e-mail do usuário.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'O e-mail já foi utilizado.'
        ];
    }
}
