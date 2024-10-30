<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use App\Domain\Core\Models\User;
use App\Domain\Core\Models\UserPhoneOtp;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Auth\VerifyPhoneRequest;
use Loctour\API\V1\Resources\User\UserResource;

class VerifyPhoneController extends APIController
{
    private $user;
    private $validated;
    public function __invoke(VerifyPhoneRequest $request)
    {
        $this->validated = $request->validated();

        if($this->isValidOtp()){
            $this->user = User::wherePhone($this->validated['phone'])->first();
            $this->user->update(['phone_verified_at' => now()]);
            $token = $this->user->createToken('app-token');
            $this->user->forceFill(['token' => $token->plainTextToken]);
            $this->user->userPhoneOtp()->delete();
            return $this->success(new UserResource($this->user));
        }
        return $this->error(__('Invalid phone or otp'));
    }

    private function isValidOtp(): bool
    {
        return UserPhoneOtp::wherePhone($this->validated['phone'])
                            ->whereOtp($this->validated['otp'])
                            ->where("expires_at", ">=", now())
                            ->exists();
    }


}
