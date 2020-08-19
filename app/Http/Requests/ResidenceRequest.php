<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidenceRequest extends FormRequest
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
            'street' => 'required|exists:streets,id',
            'number' => 'nullable|integer',
            'block' => 'nullable|string|min:1|max:50',
            'lot' => 'nullable|string|min:1|max:50',
            'parking_spaces' => 'nullable|integer',
            'extension' => 'nullable|string|min:1|max:15'
        ];
    }
}
