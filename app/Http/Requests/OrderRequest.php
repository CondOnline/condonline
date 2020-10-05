<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        $id = isset($this->route('order')->id)?$this->route('order')->id:null;

        return [
            'residence' => 'required|exists:residences,id',
            'user' => [
                'required',
                Rule::exists('residence_user', 'user_id')->where(function ($query) {
                    $query->where('residence_id', request()->residence);
                }),
            ],
            'tracking' => 'required|string|min:3|max:255|unique:orders,tracking,'. $id .',id',
            'shipping_company' => 'required|string|max:255',
            'sender' => 'required|string|min:3|max:255',
            'input_at' => 'required|date',
            'image' => 'nullable|image|size:5000'
        ];
    }

    public function messages()
    {
        return [
            'received.required_unless' => 'Campo quem recebeu é obrigatório para encomendas entregues.',
            'delivered_at.required_unless' => 'Campo data entrega é obrigatório para encomendas entregues.'
        ];
    }
}
