<?php

namespace Loctour\API\V1\Http\Requests\Auth;

use App\Domain\Core\Enums\DevicesEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'phone'         =>  'required|phone:SA|unique:users,phone',
            'password'      =>  'required',
            'fcm_token'     =>  'required|string',
            'device_type'   =>  'required|string|'.DevicesEnum::toRequestValidation(),
        ];
    }

    public function attributes()
    {
        return [
            'name'          => __('Name'),
            'username'      => __('Username'),
            'phone'     =>  __('Phone'),
            'password'  =>  __('Password'),
            'fcm_token' =>  __('FCM Token'),
            'device_type' =>  __('Device Type'),
        ];
    }
}
