<?php

namespace Loctour\API\V1\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Loctour\API\V1\Support\Traits\WithPagination;

class UserResource extends JsonResource
{
    use WithPagination;
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'name'          =>  $this->name,
            'username'      =>  $this->username,
            'avatar'        =>  $this->avatar,
            'phone'         =>  $this->phone,
            'token'         =>  $this->token ?? $request->bearerToken(),
            'created_at'    =>  $this->created_at->format('Y-m-d h:ia'),
            'updated_at'    =>  $this->updated_at->format('Y-m-d h:ia')
        ];
    }

}