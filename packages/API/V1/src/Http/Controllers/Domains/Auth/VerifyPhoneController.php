<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Illuminate\Support\Arr;
use Loctour\API\V1\Http\Controllers\APIController;
use Illuminate\Support\Facades\Auth;
use Loctour\API\V1\Http\Requests\Auth\RegisterRequest;
use App\Domain\Core\Models\User;
class VerifyPhoneController extends APIController
{
    private $user;
    private $validated;
    public function __invoke(\Request $request)
    {
        $this->validated = $request->validate(
        [
            "phone" => "required|phone:SA",
            "otp" => "required|numeric"
        ]);

        if(UserPhoneOtp::wherePhone($this->validated['phone'])
                    ->whereOtp($this->validated['otp'])
                    ->where("expire_at", ">=", now())
                    ->exist()){
            $this->user = User::wherePhone($this->validated['phone'])->first();
            $this->user->update(['phone_verified' => true]);
            $token = $this->user->createToken('app-token');
            $this->user->forceFill(['token' => $token->plainTextToken]);
            $this->user->userPhoneOtp()->delete();
            return $this->success(new UserResource($this->user));
        }
        return $this->error(__('Invalid phone or otp'));
    }

    
}
