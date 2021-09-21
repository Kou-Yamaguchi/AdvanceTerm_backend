<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'requiredlemail',
            'password' => 'required|current_password'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json([
            'status' => 400,
            'errors' => $validator->errors()
        ], 400);
    }
}
