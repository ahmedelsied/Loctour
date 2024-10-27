<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Auth\RegisterRequest;
use App\Domain\Core\Models\User;
class RegisterController extends APIController
{
    private $user;
    private $validated;
    public function __invoke(RegisterRequest $request)
    {
        $this->validated = $request->validated();
        $this->createUser();
        $this->storeFCMToken();
        $this->sendOtp();

        return $this->success(__("We've sent you a verification code to your phone"));
    }



    private function createUser()
    {
        $this->user = User::create($this->validated);
    }

    private function storeFCMToken()
    {
        $this->user->fcmTokens()
                    ->firstOrCreate([
                        'fcm_token' => $this->validated['fcm_token'],
                        'device_type' => $this->validated['device_type']
                    ]);
    }

    private function sendOtp()
    {
        $this->user->userPhoneOtp()->create([
            'phone' => $this->validated['phone'],
            'otp' => 123456, //rand(100000, 999999),
            'expires_at' => now()->addMinutes(10)
        ]);
    }

}
