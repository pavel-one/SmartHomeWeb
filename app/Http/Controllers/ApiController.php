<?php

namespace App\Http\Controllers;

use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    public function props(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'mac' => 'required|string',
            'type' => 'required|integer',
            'signal' => 'required|integer',
        ]);

        $service = resolve(DeviceService::class);
        $props = $service->getPropsDevice(
            $request->post('token'),
            $request->post('mac'),
            $request->post('type'),
            $request->post('signal'),
        );

        if (!$props) {
            return $this->fail('Not valid token or data');
        }

        return $this->success($props);
    }

    public function success(array $data = [], string $msg = 'ok'): JsonResponse
    {
        return Response::json([
            'msg' => $msg,
            'data' => $data
        ]);
    }

    public function fail(string $msg = 'fail', array $data = []): JsonResponse
    {
        return Response::json([
            'msg' => $msg,
            'data' => $data
        ]);
    }
}
