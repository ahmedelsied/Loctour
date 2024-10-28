<?php

namespace Loctour\API\V1\Http\Requests\User;

use App\Domain\Core\Enums\DevicesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'username' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'password' => 'sometimes|string|min:8|confirmed',
            'phone' => [
                'nullable',
                'sometimes',
                'string',
                'max:15',
                'phone:SA',
                Rule::unique('users','phone')->ignore($this->user()->id),
            ],
            'birthday' => 'sometimes|date',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'name'      =>  __('Name'),
            'username'  =>  __('Username'),
            'phone'     =>  __('Phone'),
            'password'  =>  __('Password'),
            'birthday'  =>  __('Birthday'),
            'avatar'    =>  __('Avatar'),
        ];
    }
}
