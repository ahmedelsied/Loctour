<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Auth;

use Loctour\API\V1\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Loctour\API\V1\Http\Requests\LoginRequest;
use Loctour\API\V1\Resources\ClientResource;

class LoginController extends APIController
{
    public function __invoke(LoginRequest $request)
    {
        if (Auth::attempt($request->validated() + [
                'tenant_id' => fn($q) => $q->where('tenant_id', '!=', ''),
                'status'    => true
            ])) {
            $client = auth()->user();

            $token = $client->createToken('playstation-app-token');

            $client->forceFill(['token' => $token->plainTextToken]);

            return $this->success(new ClientResource($client));
        }

        return $this->error(__('Invalid phone or password'));
    }
}
