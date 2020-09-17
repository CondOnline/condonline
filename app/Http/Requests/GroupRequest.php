<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
        $id = isset($this->route('group')->id)?$this->route('group')->id:null;

        return [
            'title' => 'required|string|min:3|max:255|unique:groups,title,'. $id .',id',
            'users.*' => [
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('dweller', 1);
                }),
            ],
        ];
    }
}
