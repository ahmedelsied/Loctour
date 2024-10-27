<?php

namespace Loctour\API\V1\Http\Controllers\Domains\User;

use App\Domain\Core\Models\UserPhoneOtp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\User\UpdateProfileRequest;
use Loctour\API\V1\Resources\UserResource;

class AccountController extends APIController
{

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = array_filter($request->only(['name', 'username', 'birthday']), fn($value) => !is_null($value));

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->updateAvatar($request);
        }
        if ($request->filled('phone') && $request->phone !== $user->phone) {
            // Generate OTP
            $otp = rand(100000, 999999);

            // Store OTP in user_phone_otps table with expiration (e.g., 5 minutes)
            UserPhoneOtp::updateOrCreate(
                ['user_id' => $user->id, 'phone' => $request->phone],
                ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
            );

            // Send OTP via SMS (integration with SMS service)
            // SMS::send($request->phone, "Your verification code is $otp");
        }

        $user->update($data);

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
