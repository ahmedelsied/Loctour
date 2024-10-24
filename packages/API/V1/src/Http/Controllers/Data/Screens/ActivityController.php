<?php

namespace Loctour\API\V1\Http\Controllers\Data\Screens;

use App\Domain\Core\Models\Activity;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\FilterActivityRequest;
use Loctour\API\V1\Repositories\ActivityFilterRepository;
use Loctour\API\V1\Resources\ActivityResource;

class ActivityController extends APIController
{
    public function index(FilterActivityRequest $request)
    {
        $activities = (new ActivityFilterRepository(Activity::latest(), $request->validated()))->execute()->paginate(10);
        return $this->success(ActivityResource::paginate($activities));
    }
}
