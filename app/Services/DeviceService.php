<?php

namespace App\Services;

use App\Models\DeviceStatistic;
use App\Models\User;
use App\Models\UserDevice;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceService
{
    public const ServiceName = 'Online';
    public const TTL_DAY = 60; //Время истечения статистики

    /**
     * Удаляет устаревшие записи статистики
     * @param int $ttlDay
     * @return bool
     */
    public function deleteTtlStatistic(int $ttlDay = self::TTL_DAY): bool
    {
        return true;
    }

    /**
     * Логика переключения онлайн/офлайн
     * @param UserDevice $device
     * @param bool $online
     * @return bool
     */
    public function trigger(UserDevice $device, bool $online): bool
    {
        return true;
    }

    /**
     * Формирует и отдает параметры устройства
     * @param string $token
     * @param string $mac
     * @param int $type
     * @param int $signal
     * @return array
     */
    public function getPropsDevice(string $token, string $mac, int $type, int $signal): ?array
    {
        $user = User::whereToken($token)->first();
        if (!$user) {
            return null;
        }

        $device = $this->getOrCreateDevice($user, $mac, $type);
        if (!$device) {
            return null;
        }

        $device->online($signal);

        return [];
    }

    public function getOrCreateDevice(User $user, string $mac, int $type): ?UserDevice
    {
        $device = UserDevice::where([
            'mac' => $mac,
            'type' => $type,
        ])->first();


        if (!$device) {
            if (!isset(UserDevice::getNames()[$type])) {
                return null;
            }

            $device = $user->devices()->create([
                'name' => 'Без имени',
                'type' => $type,
                'mac' => $mac,
                'signal' => 0
            ]);
        }

        if ($device->user_id !== $user->id) {
            return null;
        }


        return $device;
    }

    public function deviceFactory(int $count = 10, bool $statistic = true): Factory
    {
        $factory = UserDevice::factory()->count($count);

        if ($statistic) {
            $factory = $factory->has(
                DeviceStatistic::factory()
                    ->count(100),
                'statistic'
            );
        }

        return $factory;
    }

    public function getDeviceDaysStatisticFromWatt(UserDevice $device, int $days)
    {
        $priceWatt = 4; //Цена киловатта
        $data = $this->getDeviceDaysStatistic($device, $days);
        $all = 0;

        foreach ($data['data'] as $key => $minutes) {
            $hour = $minutes / 60;
            $price = round($device->power * $hour / 1000 * $priceWatt, 1);
            $data['data'][$key] = $price;
            $all += $price;
        }

        $data['label'] = 'Потрачено на электричество';
        $data['all'] = $all;

        return $data;
    }

    public function getDeviceDaysStatistic(UserDevice $device, int $days)
    {
        return Cache::remember($device->id . '_device_days_' . $days, 300, function () use ($device, $days) {
            $startDate = Carbon::now()->addDays(-$days);
            $all = 0;

            $query = $device->statistic()
                ->orderBy('start', 'ASC')
                ->where('start', '>=', $startDate->format('Y-m-d H:i:s'))
                ->whereNotNull('end');

            $times = [];

            for ($i = 0; $i < $days; $i++) {
                $times[Carbon::now()->addDays(-$days + $i)->format('d.m')] = 0;
            }

            $query->each(function ($stat) use (&$times) {
                /** @var DeviceStatistic $stat */
                $times[$stat->start->format('d.m')] += $stat->end->diffInMinutes($stat->start);
            });

            //Если есть незаконченные сессии
            /** @var DeviceStatistic|null $notEnd */
            $notEnd = $device->statistic()
                ->orderByDesc('start')
                ->where('start', '>=', $startDate->format('Y-m-d H:i:s'))
                ->whereNull('end')
                ->first();
            if ($notEnd) {
                $times[Carbon::now()->format('d.m')] += Carbon::now()->diffInMinutes($notEnd->start);
            }

            $keys = [];
            $data = [];
            foreach ($times as $key => $time) {
                $keys[] = $key;
                $data[] = $time;
                $all += $time;
            }

            return [
                'keys' => $keys,
                'data' => $data,
                'times' => $times,
                'label' => 'Время работы в минутах',
                'all' => round($all / 60, 1)
            ];
        });
    }
}
