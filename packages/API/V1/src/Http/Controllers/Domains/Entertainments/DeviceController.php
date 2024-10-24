<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Entertainments;

use App\Domain\Entertainments\Models\Device;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\DeviceRequest;
use Loctour\API\V1\Resources\DeviceResource;

class DeviceController extends APIController
{
    public function index()
    {
        return $this->success(DeviceResource::paginate(Device::latest()->paginate(30)));
    }

    public function store(DeviceRequest $request)
    {
        $device = Device::create($request->validated() + ['status' => true, 'active' => false]);
        return $this->success(new DeviceResource($device));
    }

    public function update(Device $device, DeviceRequest $request)
    {
        $device->update($request->validated());
        return $this->success(new DeviceResource($device));
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return $this->executed();
    }
}
