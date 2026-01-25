<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageStayRequest extends FormRequest
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
            'stayTitle'  => 'required|string|max:255',
            'stayDesc'  => 'required|string',
            // 'price'         => 'required|numeric|min:0',

            'isRibbon'      => 'nullable|boolean',
            'ribbonText'    => 'nullable|required_if:isRibbon,1|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'stayTitle.required' => 'Judul paket wajib diisi',
            // 'price.required'        => 'Harga wajib diisi',
            'ribbonText.required_if'=> 'Text ribbon wajib diisi jika ribbon aktif',
        ];
    }

     protected function prepareForValidation()
    {
        $this->merge([
            'isRibbon' => $this->has('isRibbon') ? 1 : 0,
        ]);
    }

    

}
