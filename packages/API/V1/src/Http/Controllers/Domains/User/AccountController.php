<?php

namespace Loctour\API\V1\Http\Controllers\Domains\User;

use App\Domain\Core\Models\UserPhoneOtp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Loctour\API\V1\Actions\UpdateProfileAction;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\User\UpdateProfileRequest;
use Loctour\API\V1\Resources\UserResource;

class AccountController extends APIController
{

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = array_filter($request->only(['name', 'username', 'birthday']), fn($value) => !is_null($value));

        $user = app(UpdateProfileAction::class)->execute($user,$data);

        return $this->success([
            'message' => __('Profile updated successfully. Please verify your phone number if updated.'),
            'user'  =>  new UserResource($user)
        ]);
    }
    public function delete()
    {
        auth()->user()->delete();
        return $this->success(__("Account deleted"));
    }
}
