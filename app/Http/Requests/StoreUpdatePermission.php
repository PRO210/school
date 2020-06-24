<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePermission extends FormRequest
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
        $id = $this->segment(3);

        return [
            'name'=> "required|min:3|max:255|unique:permissions,name,{$id},id",
            'label'=> 'nullable|min:3|max:255',
        ];
        
    }
    public function messages() {
        
        return [
            'name.required' => 'O campo Nome é Obrigatório',
            'label.min' => 'A Descrição deve ter no mínimo 3 caracteres ou não deve ser preenchida :)',
        ];
    }
}
