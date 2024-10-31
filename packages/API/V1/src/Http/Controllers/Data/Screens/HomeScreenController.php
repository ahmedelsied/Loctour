<?php

namespace Loctour\API\V1\Http\Controllers\Data\Screens;

use App\Domain\Content\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Resources\Content\PostResource;

class HomeScreenController extends APIController
{
    public function __invoke()
    {
        $posts = Post::latest('id')
                    ->withCount('likes','comments')
                    ->withExists(['likes as is_liked' => function (Builder $query) {
                        $query->where('user_id', auth()->id());
                    }])
                    ->paginate(20);
        return $this->success(PostResource::paginate($posts));
    }
}
