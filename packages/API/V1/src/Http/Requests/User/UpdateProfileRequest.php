<?php

namespace Loctour\API\V1\Http\Requests\User;

use App\Domain\Core\Enums\DevicesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
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
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'sometimes|required_with:current_password|string|min:8|confirmed',
            'phone' => [
                'nullable',
                'sometimes',
                'string',
                'max:15',
                'phone:SA',
                Rule::unique('users','phone')->ignore($this->user()->id),
            ],
            'birthdate' => 'sometimes|date|date_format:Y-m-d',
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if the current password is correct
            if ($this->has('current_password') && !Hash::check($this->current_password, $this->user()->password)) {
                $validator->errors()->add('current_password', 'The current password is incorrect.');
            }
        });
    }
}
