<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CarRentalRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'pricehalfday' => 'required|numeric|min:0',
            'pricefullday' => 'required|numeric|min:0',
            'pricewholeday' => 'required|numeric|min:0',
            'priceadditional' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Tipe wajib diisi',
            'pricehalfday.required' => 'Harga Half Day wajib diisi',
            'pricefullday.required' => 'Harga Full Day wajib diisi',
            'pricewholeday.required' => 'Harga Whole Day wajib diisi',
            'priceadditional.required' => 'Harga Additional Hours wajib diisi',
        ];
    }

    protected function prepareForValidation()
    {
        // Normalize numeric fields to remove commas or other formatting
        $this->merge([
            'pricehalfday' => $this->normalizeNumber($this->pricehalfday),
            'pricefullday' => $this->normalizeNumber($this->pricefullday),
            'pricewholeday' => $this->normalizeNumber($this->pricewholeday),
            'priceadditional' => $this->normalizeNumber($this->priceadditional),
        ]);
    }
    private function normalizeNumber($value)
    {
        // Remove commas and other formatting
        return is_string($value) ? str_replace(',', '', $value) : $value;
    }
}
