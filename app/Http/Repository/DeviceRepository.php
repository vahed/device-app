<?php

namespace App\Http\Repository;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

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
        Device::firstOrCreate([
            'model' => $request->model,
            'brand' => $request->brand,
            'release_date' => $request->release_date,
            'os' => $request->os,
            'is_new' => $request->is_new,
            'created_datetime' => now(),
            'update_datetime' => now()
        ]);
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