<?php

namespace App\Http\Requests;


use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'quantity' => 'required|gt:0',
            'discount_price' => 'exclude_if:discount_price,null|gte:0|lte:price',
            ''

        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'Een aantal is verplicht',
            'quantity.gt' => 'Het aantal moet meer dan 0 zijn.',

            'discount_price.gte' => 'De korting moet hoger dan of gelijk zijn aan 0.',
            'discount_price.lte' => 'De korting mag niet hoger of gelijk zijn aan de product prijs.'
        ];
    }
}
