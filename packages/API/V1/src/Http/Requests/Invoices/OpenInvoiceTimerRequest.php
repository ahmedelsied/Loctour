<?php

namespace Loctour\API\V1\Http\Requests\Invoices;

use App\Domain\Finance\Enums\EntertainmentTypesEnum;
use App\Domain\Finance\Enums\TimerTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OpenInvoiceTimerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'timer_name'    =>  'required|string|max:70',
            'timer_type'    =>  'required|string|in:' . implode(',', TimerTypeEnum::toValues()),
//            'end_time'      =>  'nullable|filled|date|date_format:Y-m-d H:i:s|after:now',
            'item_type'     =>  'required|string|in:' . implode(',', EntertainmentTypesEnum::toValues()),
            'item_id'       =>  ['required',
                                    Rule::exists(str(request('item_type'))->plural()->value(), 'id')
                                    ->where('active', false)->where('status', true)]
        ];
    }

    public function validated($key = null, $default = null)
    {
        return ['item_type' => EntertainmentTypesEnum::toModels()[$this->item_type]] + parent::validated();
    }

    public function attributes()
    {
        return [
            'timer_name'    =>  __('Timer Name'),
            'timer_type'    =>  __('Timer Type'),
//            'end_time'      =>  __('End Time'),
            'item_type'     =>  __('Item Type'),
            'item_id'       =>  __('Item ID')
        ];
    }
}
