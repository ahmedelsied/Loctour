<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Content;

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
            $post->addMedia($validated['media'])->toMediaCollection();
        }
        $post->loadCount('likes','comments');
        return $this->success(new PostResource($post));
    }
}
