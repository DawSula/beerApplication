<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
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
        $id = Auth::id();
        return [
            'email' =>
                [
                    'required',
                    Rule::unique('users')->ignore($id),
                    'email'
                ],

            'name' =>
                [
                    'required', 'max:20',
                ],
            'avatar' =>
                [
                    'nullable', 'file', 'image'
                ],

        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Podany email jest już zajęty',
            'name.max' => 'Maksymalna ilość znaków: :max'
        ];
    }
}
