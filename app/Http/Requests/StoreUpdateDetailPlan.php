<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDetailPlan extends FormRequest
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
    //
    //
    public function rules()
    {
        return [
            'name'=> 'required|min:3|max:255',
        ];
    }
    //
    public function messages() {
        
        return [
            'name.required' => 'O campo Nome é Obrigatório',
            'name.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
        ];
    }
    //
    //
}
