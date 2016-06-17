<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usuario' => 'required|between:5,15|unique:usuario,usuario',
            'senha' => 'required|min:6',
            'confirma_senha' => 'required|same:senha',
        ];
    }

    public function attributes()
    {
        $return = [
            'usuario' => 'Usuário',
            'senha' => 'Senha',
            'confirma_senha' => 'Confirmar Senha'
        ];

        return $return;
    }

    public function messages()
    {
        $return = [
            'usuario.required' => 'Informe um Usuário válido.',
            'usuario.between' => 'Informe um valor entre 5 e 15 caracteres.',
            'usuario.unique' => 'O Usuário informado já esta em uso.',
            'senha.required' => 'Informe uma Senha válida.',
            'senha.min' => 'A senha deve conter no minimo 6 caracteres.',
            'confirma_senha.required' => 'Confirme a Senha.',
            'confirma_senha.same' => 'Confirmação inválida.'
        ];

        return $return;
    }
}
