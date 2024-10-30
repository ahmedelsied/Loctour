<?php

namespace Loctour\API\V1\Http\Controllers\Domains\User;

use Loctour\API\V1\Actions\User\UpdateProfileAction;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\User\UpdateProfileRequest;
use Loctour\API\V1\Resources\User\UserResource;

class AccountController extends APIController
{

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = array_filter($request->validated(), fn($value) => !is_null($value));

        $user = app(UpdateProfileAction::class)->execute($user,$data);

        return $this->success([
            'message' => __('Profile updated successfully'),
            'user'  =>  new UserResource($user)
        ]);
    }
    public function delete()
    {
        auth()->user()->delete();
        return $this->success(__("Account deleted"));
    }
}
