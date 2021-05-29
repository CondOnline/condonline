<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UniqueEncrypt;

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
        $id = isset($this->route('user')->id)?$this->route('user')->id:null;

        return [
            'userAccessGroup' => 'required|exists:user_access_groups,id',
            'name' => 'required|string|min:3|max:255',
            //'cpf' => 'nullable|string|min:9|max:14|unique:users,cpf,'. $id .',id',
            'cpf' => ['nullable', 'string', 'min:9', 'max:14', new UniqueEncrypt('users', $id, 'id')],
            'rg' => 'nullable|string|min:3|max:50',
            'gender' => [
                Rule::in(['female', 'male'])
            ],
            'mobile_phone' => 'nullable|string|min:8|max:15',
            'birth' => 'nullable|date',
            'email' => 'required|string|email|min:3|max:255|unique:users,email,'. $id .',id',
            'residences.*' => 'exists:residences,id',
            'dweller' => 'required|boolean',
            'blocked' => 'boolean'
        ];
    }
}
