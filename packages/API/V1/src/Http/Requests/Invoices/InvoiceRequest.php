<?php

namespace Loctour\API\V1\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:70',
            'notes' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'notes' => __('Notes')
        ];
    }
}
