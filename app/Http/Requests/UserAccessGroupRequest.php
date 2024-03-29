<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAccessGroupRequest extends FormRequest
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
        $id = isset($this->route('userAccessGroup')->id)?$this->route('userAccessGroup')->id:null;

        return [
            'permissions.*' => 'exists:permissions,id',
            'title' => 'required|min:3|max:255|unique:user_access_groups,title,'. $id .',id',
            'description' => 'required|min:3'
        ];
    }
}
