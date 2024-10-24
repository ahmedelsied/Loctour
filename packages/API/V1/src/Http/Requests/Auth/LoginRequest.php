<?php

namespace Loctour\API\V1\Http\Requests\Auth;

use App\Domain\Core\Enums\DevicesEnum;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone'         =>  'required|phone:SA',
            'password'      =>  'required',
            'fcm_token'     =>  'required|string',
            'device_type'   =>  'required|string|'.DevicesEnum::toRequestValidation(),
        ];
    }

    public function attributes()
    {
        return [
            'phone'     =>  __('Phone'),
            'password'  =>  __('Password'),
            'fcm_token' =>  __('FCM Token'),
        ];
    }
}
