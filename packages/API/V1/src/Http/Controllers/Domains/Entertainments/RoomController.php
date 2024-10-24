<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Entertainments;

use App\Domain\Entertainments\Models\Room;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\RoomRequest;
use Loctour\API\V1\Resources\RoomResource;

class RoomController extends APIController
{
    public function index()
    {
        return $this->success(RoomResource::paginate(Room::latest()->paginate(30)));
    }

    public function store(RoomRequest $request)
    {
        $room = Room::create($request->validated() + ['status' => true, 'active' => false]);
        return $this->success(new RoomResource($room));
    }

    public function update(Room $room, RoomRequest $request)
    {
        $room->update($request->validated());
        return $this->success(new RoomResource($room));
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return $this->executed();
    }
}
