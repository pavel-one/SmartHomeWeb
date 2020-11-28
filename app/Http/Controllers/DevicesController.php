<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DevicesController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $devices = $user->devices;

        return Inertia::render('devices', [
            'title' => 'Мои устройства',
            'devices' => $devices,
        ]);
    }
}
