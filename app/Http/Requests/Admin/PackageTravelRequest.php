<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageTravelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'packageTitle'  => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',

            'tourTimeFrom' => ['nullable', 'regex:/^\d{2}:\d{2}$/'],
            'tourTimeTo'   => ['nullable', 'regex:/^\d{2}:\d{2}$/'],

            'isPromo'       => 'nullable|boolean',
            'promoPrice'    => 'nullable|required_if:isPromo,1|numeric|min:0',

            'isRibbon'      => 'nullable|boolean',
            'ribbonText'    => 'nullable|required_if:isRibbon,1|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'packageTitle.required' => 'Judul paket wajib diisi',
            'price.required'        => 'Harga wajib diisi',
            'promoPrice.required_if'=> 'Harga promo wajib diisi jika promo aktif',
            'ribbonText.required_if'=> 'Text ribbon wajib diisi jika ribbon aktif',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'isPromo'  => $this->has('isPromo') ? 1 : 0,
            'isRibbon' => $this->has('isRibbon') ? 1 : 0,
            'tourTimeFrom' => $this->normalizeTime($this->tourTimeFrom),
            'tourTimeTo'   => $this->normalizeTime($this->tourTimeTo),
        ]);
    }

    private function normalizeTime($value)
    {
        if (!$value) return null;

        // kalau format HH:mm:ss → ambil HH:mm
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $value)) {
            return substr($value, 0, 5);
        }

        return $value;
    }
}
