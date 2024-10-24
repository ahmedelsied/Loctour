<?php

namespace Loctour\API\V1\Support\Services;

use Loctour\API\V1\Support\Services\APIResponse\ApiResponse;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseHelper
{
    private $auth;

    private $user;

    public function __construct()
    {
        try {
            $this->auth = Firebase::auth();
        } catch (\InvalidArgumentException $e) {
            abort(200, $e->getMessage());
        }
    }

    public function setUser($uuid)
    {
        $this->user = $this->auth->getUser($uuid);
    }

    public function deleteUser()
    {
        $this->user->delete();
    }

    public function isVerifiedPhoneNumber($phone)
    {
        if ($this->user?->phoneNumber != $phone) {
            abort(ApiResponse::error(__('Phone number is not verified')));
        }

        return true;
    }

    public function getUser()
    {
        return $this->user;
    }
}
