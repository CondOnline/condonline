<?php

namespace App\Http\Requests;

use App\Rules\grecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Fortify;

class LoginRequest extends \Laravel\Fortify\Http\Requests\LoginRequest
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
            Fortify::username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', new grecaptcha()]
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.*' => __('Failed on reCAPTCHA verification.')
        ];
    }
}
