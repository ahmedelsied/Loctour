<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Core;

use App\Domain\Core\Models\User;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\UserRequest;
use Loctour\API\V1\Resources\UserResource;

class UserController extends APIController
{
    public function index()
    {
        return $this->success(UserResource::paginate(
            User::whereKeyNot(auth()->id())
                ->paginate(20)
        ));
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());
        return $this->success(new UserResource($user));
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());
        return $this->success(new UserResource($user));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->executed();
    }

}
