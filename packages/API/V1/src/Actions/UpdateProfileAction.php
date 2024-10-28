<?php

namespace Loctour\API\V1\Actions;

use App\Domain\Core\Models\UserPhoneOtp;
use Illuminate\Support\Facades\Hash;

class UpdateProfileAction
{
    public function execute($user, $data)
    {
        // Filter non-null data and handle password if provided
        $updateData = array_filter($data, fn($value) => !is_null($value) && $value !== 'password');
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        // Handle avatar upload if provided
        if (!empty($data['avatar'])) {
            $this->updateAvatar($user, $data['avatar']);
        }

        // Handle phone number update
        if (!empty($data['phone']) && $data['phone'] !== $user->phone) {
            $this->generateAndStoreOtp($user, $data['phone']);
        }

        // Update user profile
        $user->update($updateData);

        return $user->fresh();
    }

    private function updateAvatar($user, $avatar)
    {
        $user->clearMediaCollection();
        $user->addMedia($avatar)->toMediaCollection();
    }

    private function generateAndStoreOtp($user, $phone)
    {
        $otp = 123456; //rand(100000, 999999);

        UserPhoneOtp::updateOrCreate(
            ['user_id' => $user->id, 'phone' => $phone],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(5)]
        );

    }
}
