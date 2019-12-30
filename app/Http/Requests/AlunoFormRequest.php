<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoFormRequest extends FormRequest
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
            'NOME' => 'required',
            'NOME' => 'min:3',
            'TURMA' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'NOME.required' => 'O Campo Nome Precisa ser Preenchido!',
            'NOME.min' => 'O Campo Nome Precisa 3 caracateres no minímo!',
            'TURMA.required' => 'O Campo Turma Precisa ser Preenchido!'
        ];
    }
}
