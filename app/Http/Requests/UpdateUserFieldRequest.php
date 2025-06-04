<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserFieldRequest extends FormRequest
{
    public function authorize()
    {
        // Pastikan hanya user login yang bisa ubah data-nya
        return Auth::check();
    }

    public function rules()
    {
        return [
            'field' => 'required|string|in:name,birthdate,gender,address,email,phone',
            'value' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'field.in' => 'Field yang dikirim tidak valid.',
        ];
    }
}
