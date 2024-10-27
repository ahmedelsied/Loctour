<?php

namespace Loctour\API\V1\Http\Requests\Auth;

use App\Domain\Core\Enums\DevicesEnum;
use Illuminate\Foundation\Http\FormRequest;

class VerifyPhoneRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => format($this->get('phone'))->phone('SA')
        ]);
    }
    public function rules()
    {
        return [
            "phone" => "required|string|phone:SA",
            "otp" => "required|numeric"
        ];
    }

    public function attributes()
    {
        return [
            'phone'     =>  __('Phone'),
            'otp'  =>  __('OTP'),
        ];
    }
}
