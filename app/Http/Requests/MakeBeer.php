<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class MakeBeer extends FormRequest
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
//        dd($this->request->all());
        return [
            'name'=>
            [
                'required',
                'max:20'
            ],
            'image'=>
            [
                'nullable',
                'file',
                'image'
            ],
            'style'=>
            [
                'required',
            ],
            'description'=>'required'


        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Wymagana jest nazwa',
            'name.max' => 'Maksymalna ilość znaków: :max',
            'image.image' => 'Plik musi być w formacie jpg/png',
            'style.required'=>'Gatunek jest wymagany',
            'description.required'=>'Opis jest wymagany',
        ];
    }
}
