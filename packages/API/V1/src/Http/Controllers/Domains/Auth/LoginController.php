<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Auth\LoginRequest;
use Loctour\API\V1\Resources\User\AuthUserResource;

class LoginController extends APIController
{
    private $user;
    private $validated;
    public function __invoke(LoginRequest $request)
    {
        $this->validated = $request->validated();
        if (Auth::attempt(Arr::only($this->validated,['phone','password']))) {
            $this->user = auth()->user();
            $this->checkPhoneVerified();
            $token = $this->user->createToken('app-token');
            $this->storeFCMToken();
            $this->user->forceFill(['token' => $token->plainTextToken]);

            return $this->success(new AuthUserResource($this->user));
        }

        return $this->error(__('Invalid phone or password'));
    }

    private function storeFCMToken()
    {
        $this->user->fcmTokens()
                    ->firstOrCreate([
                        'fcm_token' => $this->validated['fcm_token'],
                        'device_type' => $this->validated['device_type']
                    ]);
    }

    private function checkPhoneVerified()
    {
        if($this->user->phone_verified_at == null){
            abort($this->error(__('Phone not verified yet')), 400);
        }
    }
}
