<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Content;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Content\PostRequest;
use Loctour\API\V1\Resources\Content\PostResource;

class PostController extends APIController
{
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $post = auth()->user()->posts()->create(Arr::except($validated,['media']));
        if(Arr::has($validated,'media')){
            foreach($validated['media'] as $media)  $post->addMedia($media)->toMediaCollection();
        }
        $post->loadCount('likes','comments');
        $post->loadExists(['likes as is_liked' => function (Builder $query) {
            $query->where('user_id', auth()->id());
        }]);
        return $this->success(new PostResource($post));
    }
}
