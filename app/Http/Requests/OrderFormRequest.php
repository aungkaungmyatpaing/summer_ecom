<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => [
                'required',
                'string',
                'max:121'
            ],
            'email' => [
                'required',
                'email',
                'max:121'
            ],
            'phone' => [
                'required',
                'string',
                'max:11',
                'min:10'
            ],
            'pincode' => [
                'required',
                'string',
                'max:6',
                'min:6'
            ],
            'address' => [
                'required',
                'string',
                'max:500'
            ]
        ];
    }
}
