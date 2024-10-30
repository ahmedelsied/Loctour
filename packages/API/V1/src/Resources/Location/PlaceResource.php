<?php

namespace Loctour\API\V1\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;
use Loctour\API\V1\Resources\User\UserResource;
use Loctour\API\V1\Support\Traits\WithPagination;

class PlaceResource extends JsonResource
{
    use WithPagination;
    public function toArray($request)
    {
        return [
            'id'        =>  $this->id,
            'media'     =>  $this->getMedia(),
            'name'      =>  $this->name,
            'type'      =>  $this->type,
            'longitude' =>  $this->longitude,
            'latitude'  =>  $this->latitude,
            'trend'     =>  $this->trend,
        ];
    }

}
