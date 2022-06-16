<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repository\DeviceRepository;

class DeviceController extends Controller
{
    public $deviceRepository;

    public function __construct(DeviceRepository $devices)
    {
        $this->deviceRepository = $devices;
    }

    public function showAllDevices()
    {
        return response()->json($this->deviceRepository->getDevices(), 200);
    }

    public function showSingleDevice($id)
    {
        return response()->json($this->deviceRepository->getSingleDevice($id), 200);
    }

    public function storeNewDevice(Request $request)
    {
        return response()->json($this->deviceRepository->addNewDevice($request));
    }

    public function destroyDevice($id)
    {
        return response()->json($this->deviceRepository->deleteDevice($id));
    }

}
