<?php

namespace Loctour\API\V1\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class OrderProductRequest extends FormRequest
{
    public function rules()
    {
        if($this->isMethod('PUT')){
            return [
                'quantity'  =>  'required|integer',
            ];
        }

        return [
            'quantity'  =>  'required|integer|max:'.$this->stock->quantity,
        ];
    }
    public function withValidator($validator)
    {
        if($this->stock->quantity <= 0 && $this->isMethod('POST')){
            $validator->errors()->add('stock', __('The selected stock item is out of stock'));
            throw new ValidationException($validator);
        }
    }

    public function attributes()
    {
        return [
            'quantity'  =>  __('Quantity'),
        ];
    }
}
