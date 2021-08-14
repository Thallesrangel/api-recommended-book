<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        if ($this->isMethod('put')) {
            return  [
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'email' => 'unique:user,email,' . $this->user
            ];
        } 

        return [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|max:30|unique:user,email'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo obrigatório.',
            'max' => 'Tamanho máximo de 30 caractéres',
            'unique' => 'Este registro já existe.'
        ];
    }
}