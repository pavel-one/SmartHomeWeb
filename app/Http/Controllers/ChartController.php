<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use App\Services\DeviceService;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function workChart(UserDevice $device, Request $request)
    {
        $request->validate([
            'day' => 'required|integer|max:60'
        ]);
        $service = resolve(DeviceService::class);

        return $service->getDeviceDaysStatistic($device, $request->get('day'));
    }

    public function wattChart(UserDevice $device, Request $request)
    {
        $request->validate([
            'day' => 'required|integer|max:60'
        ]);

        $service = resolve(DeviceService::class);
        $data = $service->getDeviceDaysStatistic($device, $request->get('day'));

        return $service->formatFromWattStat($data, $device->power);
    }
}
