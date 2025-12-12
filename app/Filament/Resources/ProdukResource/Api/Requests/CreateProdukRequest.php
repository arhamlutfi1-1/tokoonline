<?php

namespace App\Filament\Resources\ProdukResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProdukRequest extends FormRequest
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
			'nama_barang' => 'required',
			'kode_barang' => 'required',
			'tgl_masuk' => 'required|date',
			'quantity' => 'required',
			'product_description_long' => 'required|string',
			'product_description_short' => 'required|string',
			'price' => 'required|numeric'
		];
    }
}
