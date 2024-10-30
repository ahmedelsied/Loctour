<?php

namespace Loctour\API\V1\Actions\User;

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

        // Update user profile
        $user->update($updateData);

        return $user->fresh();
    }

    private function updateAvatar($user, $avatar)
    {
        $user->clearMediaCollection();
        $user->addMedia($avatar)->toMediaCollection();
    }

}
