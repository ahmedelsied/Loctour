<?php

namespace Loctour\API\V1\Http\Controllers\Data\Screens;

use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Resources\SubscriptionResource;

class SubscriptionController extends APIController
{
    public function __invoke()
    {
        $subscriptions = tenant()->subscriptions()->latest();
        if(request()->has('active')){
            request('active') ? $subscriptions->active() : $subscriptions->inactive();
        }
        return $this->success(SubscriptionResource::paginate($subscriptions->paginate(20)));
    }
}
