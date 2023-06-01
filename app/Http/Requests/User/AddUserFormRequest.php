<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:200'
            ],

            'email' => [
                'required',
                'email',
                'unique:users',
                'max:200'
            ],
            'phone' => [
                'required',
                // 'unique',
            ],
            'pic1' => [
                'nullable',

            ],
            'pic2' => [
                'nullable',

            ],
            'pic3' => [
                'nullable',

            ],
            'pic4' => [
                'nullable',

            ],
            'dob' => [
                'required',

            ],
            'gender' => [
                'string',
                'required',

            ],
            'interested_in' => [
                'required',

            ],
            // 'status'=>
            // [
            //     'nullable',
            // ]

        ];
        return $rules;
    }
}
