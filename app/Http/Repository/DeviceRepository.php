<?php

namespace App\Http\Repository;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DeviceRepository
{
    /**
     * List all the devices including Brand, Model, OS and Release Date
     */
    public function getDevices(): Object
    {
        return Device::all();
    }

    /**
     * List device record by id
     */
    public function getSingleDevice($id): Object
    {
        return Device::find($id);
    }

    /**
     * Ability to add a new device 
     */
    public function addNewDevice($request)
    {
        $currentDateTime = now()->toDateTimeString();

        Device::firstOrCreate([
            'model' => $request->model,
            'brand' => $request->brand,
            'release_date' => $request->release_date,
            'os' => $request->os,
            'is_new' => $request->is_new,
            'created_datetime' => $currentDateTime,
            'update_datetime' => $currentDateTime
        ]);

        return response()->json('New Device added');
    }

    /**
     * Ability to update device
     */
    public function updateDevice($request)
    {
        $currentDateTime = now()->toDateTimeString();
 
        $device = Device::find($request->id);

        $device->brand = $request->brand;
        $device->model = $request->model;
        $device->os = $request->os;
        $device->release_date = $request->release_date;
        $device->update_datetime = $currentDateTime;

        $device->save();
        return response()->json('Device updated!');

    }

    /**
     * Ability to delete a device 
     */
    public function deleteDevice($id)
    {
        $device = Device::find($id);
        $device->delete();
        return response()->json('Device deleted!');
    }

}