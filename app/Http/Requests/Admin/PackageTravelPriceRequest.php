<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageTravelPriceRequest extends FormRequest
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
            'travelpackageid' => 'required|exists:mt_travel_package,travelpackageid',
            'packagePriceTitle' => 'required_without:price|max:255',
            'price' => 'required_without:packagePriceTitle',
            'pricePer' => 'nullable|string|max:100',
            'isPromo' => 'nullable|boolean',
            'promoPrice' => 'required_if:isPromo,1|required_if:isPromo,on|nullable',
            'priceDesc' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'packagePriceTitle.required_without' => 'Judul Harga harus diisi jika Harga tidak diisi',
            'price.required_without' => 'Harga harus diisi jika Judul Harga tidak diisi',
            'promoPrice.required_if' => 'Harga Promo harus diisi jika Promo diaktifkan',
        ];
    }
}
