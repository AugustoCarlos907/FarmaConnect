<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarPedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'farmacia_id' => 'required|exists:farmacias,id',
            'endereco_entrega' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.stock_id' => 'required|exists:farmacia_medicamentos,id',
            'items.*.quantidade' => 'required|integer|min:1',
        ];
    }
}
