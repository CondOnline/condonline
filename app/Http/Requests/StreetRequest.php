<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StreetRequest extends FormRequest
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
        $id = isset($this->route('street')->id)?$this->route('street')->id:null;

        return [
            'long' => 'required|string|min:3|max:255|unique:streets,long,'. $id .',id',
            'short' => 'required|string|min:1|max:25|unique:streets,short,'. $id .',id'
        ];
    }
}
