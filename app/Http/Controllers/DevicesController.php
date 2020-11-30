<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DevicesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('devices', [
            'title' => 'Мои устройства',
        ]);
    }

    public function devices(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        return $user->devices;
    }

    public function show(UserDevice $device)
    {
        return Inertia::render('device', [
            'device' => $device
        ]);
    }
}
