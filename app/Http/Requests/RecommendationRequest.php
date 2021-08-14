<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecommendationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        if ($this->isMethod('put')) {
            return [
                'title' => 'required|string',
                'description' => 'required|string'
            ];
        }

        return [
            'user_indicator' => 'required',
            'user_indicated' => 'required',
            'title' => 'required|string',
            'description' => 'required|string'
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