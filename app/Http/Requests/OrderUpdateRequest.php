<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'shipping_company' => 'required|string|max:255',
            'sender' => 'required|string|min:3|max:255',
            'input_at' => 'required|date',
            'received' => 'required_unless:delivered_at,|nullable|string|min:3|max:255',
            'delivered_at' => 'required_unless:received,|nullable|date',
            'image' => 'nullable|image|size:5000',
            'image_signature' => 'nullable|image|size:5000'
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
