<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Illuminate\Http\Request;
use Loctour\API\V1\Http\Controllers\APIController;
use App\Domain\Core\Models\User;
class ResendOtpController extends APIController
{
    private $user;
    private $validated;
    public function __invoke(Request $request)
    {
        $this->validated = $request->validate([
            'phone' =>  'required|string|phone:SA'
        ]);

        $this->user = User::whereNull('phone_verified_at')
                            ->wherePhone($this->validated['phone'])->first();

        if(!is_null($this->user)){
            $this->sendOtp();
            return $this->success(__("We've sent you a verification code to your phone"));
        }

        return $this->success(__("Invalid phone number"));
    }

    private function sendOtp()
    {
        $this->user->userPhoneOtp()->delete();
        $this->user->userPhoneOtp()->create([
            'phone' => $this->validated['phone'],
            'otp' => 123456, //rand(100000, 999999),
            'expires_at' => now()->addMinutes(10)
        ]);
    }

}
