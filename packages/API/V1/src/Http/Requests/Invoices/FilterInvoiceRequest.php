<?php

namespace Loctour\API\V1\Http\Requests\Invoices;

use App\Domain\Finance\Enums\DiscountTypeEnum;
use App\Domain\Finance\Enums\InvoiceStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class FilterInvoiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status'    =>  'nullable|filled|string|in:'. implode(',', InvoiceStatusEnum::toValues()),
            'date_from' =>  'nullable|filled|required_with:date_to|date|date_format:Y-m-d',
            'time_from' =>  'nullable|filled|required_with:date_from|date_format:H:i',
            'date_to' =>  'nullable|filled|required_with:date_from|date|date_format:Y-m-d',
            'time_to' =>  'nullable|filled|required_with:date_to|date_format:H:i'
        ];
    }

    public function attributes()
    {
        return [
            'status'    =>  __('Invoice Status'),
            'from'      =>  __('From'),
            'to'        =>  __('To')
        ];
    }
}
