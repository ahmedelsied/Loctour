<?php

namespace Loctour\API\V1\Http\Requests\Invoices;

use App\Domain\Finance\Enums\DiscountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CloseInvoiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'discount_type'    =>  'nullable|filled|required_with:discount_value|string|in:'.implode(',', DiscountTypeEnum::toValues()),
            'discount_value'   =>  'nullable|filled|required_with:discount_type|numeric|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'discount_type'     =>  __('Discount Type'),
            'discount_value'    =>  __('Discount Value')
        ];
    }
}
