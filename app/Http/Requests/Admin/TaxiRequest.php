<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TaxiRequest extends FormRequest
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
            'destinationid_from' => 'required|exists:mt_destination,destinationid',
            'destinationid' => 'required|exists:mt_destination,destinationid',
            'price7seatoneway' => 'required|numeric|min:0',
            'price7seattwoway' => 'required|numeric|min:0',
            'price14seatoneway' => 'required|numeric|min:0',
            'price14seattwoway' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'destinationid_from.required' => 'Destination From wajib diisi',
            'destinationid_from.exists' => 'Destination From tidak valid',
            'destinationid.required' => 'Destination To wajib diisi',
            'destinationid.exists' => 'Destination To tidak valid',
            'price7seatoneway.required' => 'Harga 7 Seat One Way wajib diisi',
            'price7seattwoway.required' => 'Harga 7 Seat Two Way wajib diisi',
            'price14seatoneway.required' => 'Harga 14 Seat One Way wajib diisi',
            'price14seattwoway.required' => 'Harga 14 Seat Two Way wajib diisi',
        ];
    }

    protected function prepareForValidation()
    {
        // Normalize numeric fields to remove commas or other formatting
        $this->merge([
            'price4seatoneway' => $this->normalizeNumber($this->price4seatoneway),
            'price4seattwoway' => $this->normalizeNumber($this->price4seattwoway),
            'price7seatoneway' => $this->normalizeNumber($this->price7seatoneway),
            'price7seattwoway' => $this->normalizeNumber($this->price7seattwoway),
            'price14seatoneway' => $this->normalizeNumber($this->price14seatoneway),
            'price14seattwoway' => $this->normalizeNumber($this->price14seattwoway),
        ]);
    }

    private function normalizeNumber($value)
    {
        if (!$value) return null;

        // Remove any non-numeric characters except for the decimal point
        return preg_replace('/[^\d.]/', '', $value);
    }
}
