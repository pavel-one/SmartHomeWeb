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

    public function update(UserDevice $device, Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        if ($device->user_id !== $user->id) {
            return back()->withErrors(['Ошибка сохранения']);
        }

        if ($request->post('power') > 2000) {
            return back()->withErrors(['Мощность не может превышать 2кВт']);
        }

        if ($device->update($request->post())) {
            return back()->with(['success' => ['Успешно сохранено']]);
        }

        return back()->withErrors(['Ошибка сохранения']);
    }
}
