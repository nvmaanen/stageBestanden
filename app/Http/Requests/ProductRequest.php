<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role_id == Role::ADMIN;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|gt:0',
            'description' => 'required',
            'name' => 'required',
            'discount_price' => 'exclude_if:discount_price,null|numeric|gte:0|lte:price',
            'vat' => 'required|gte:0|lt:22'
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Vul een prijs in.',
            'price.gt' => 'De prijs moet hoger zijn dan 0.',
            'price.numeric' => 'Gebruik een punt in plaats van een komma.',
            'name.required' => 'Een productnaam is verplicht',
            'description.required' => 'Een beschrijving is verplicht',
            'discount_price.numeric' => 'Gebruik een punt in plaats van een komma.',
            'discount_price.gte' => 'De korting moet hoger dan of gelijk zijn aan 0.',
            'discount_price.lte' => 'De korting mag niet hoger of gelijk zijn aan de product prijs.',
            'vat.required' => 'Vul een BTW percentage in.',
            'vat.gte' => 'Het BTW percentage moet hoger dan of gelijk zijn aan 0.',
            'vat.lt' => 'Het BTW percentage moet 21% of lager zijn.'
        ];
    }
}
