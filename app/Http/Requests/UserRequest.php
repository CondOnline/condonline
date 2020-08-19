<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'userAccessGroup' => 'required|exists:user_access_groups,id',
            'name' => 'required|string|min:3|max:255',
            'cpf' => 'nullable|string|min:9|max:14',
            'rg' => 'nullable|string|min:3|max:50',
            'gender' => [
                Rule::in(['female', 'male'])
            ],
            'mobile_phone' => 'nullable|string|min:8|max:15',
            'birth' => 'nullable|date',
            'photo' => 'nullable|image',
            'email' => 'required|string|email|min:3|max:255|unique:users,email'. $this->route('user') .',id',
            'residences.*' => 'exists:residences,id',
            'password' => 'string|min:8',
            'status' => 'boolean'
        ];
    }
}
