<?php

namespace Loctour\API\V1\Resources\Content;

use Illuminate\Http\Resources\Json\JsonResource;
use Loctour\API\V1\Resources\Location\PlaceResource;
use Loctour\API\V1\Resources\User\UserResource;
use Loctour\API\V1\Support\Traits\WithPagination;

class PostResource extends JsonResource
{
    use WithPagination;
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'content'       =>  $this->content,
            'likes_count'   =>  $this->likes_count,
            'comments_count'=>  $this->comments_count,
            'user'          =>  new UserResource($this->user),
            'place'         =>  new PlaceResource($this->place),
            'is_liked'      =>  $this->isLiked,
            'created_at'    =>  $this->created_at->format('Y-m-d h:ia'),
        ];
    }

}