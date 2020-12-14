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

    /**
     * Получает или создает новое устройства от мак адреса и типа
     * @param User $user
     * @param string $mac
     * @param int $type
     * @return UserDevice|null
     */
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

    /**
     * Фабрика создания устройства
     * @param int $count
     * @param bool $statistic
     * @return Factory
     */
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

    /**
     * Получение статистики онлайна и других параметров для графика
     * @param UserDevice $device
     * @param int $days
     * @return array
     */
    public function getDeviceDaysStatistic(UserDevice $device, int $days): array
    {
        if ($days === 1) {
            return $this->getHourStat($device); //Не кешируется
        }

        return Cache::remember($device->id . '_device_days_' . $days, 300, function () use ($device, $days) {
            return $this->getDayStat($device, $days);
        });
    }

    /**
     * Форматирует в ватты статистику онлайна
     * @param array $data
     * @param int $devicePower - мощность устройства в ваттах
     * @param int $priceWatt - цена киловатта
     * @return array
     */
    public function formatFromWattStat(array $data, int $devicePower = 0, $priceWatt = 4): array
    {
        $all = 0;

        foreach ($data['data'] as $key => $minutes) {
            $hour = $minutes / 60;
            $price = round($devicePower * $hour / 1000 * $priceWatt, 1);
            $data['data'][$key] = $price;
            $all += $price;
        }

        $data['label'] = 'Потрачено на электричество';
        $data['all'] = round($all, 1);

        return $data;
    }

    /**
     * Получение статистики онлайна за текущий день по часам
     * @param UserDevice $device
     * @return array
     */
    private function getHourStat(UserDevice $device): array
    {
        $now = Carbon::now();
        $startDate = Carbon::now()->set([
            'hour' => 0,
            'minute' => 0,
            'second' => 0,
        ]);

        $query = $device->statistic()
            ->orderBy('start', 'ASC')
            ->where('start', '>=', $startDate->format('Y-m-d H:i:s'));

        $times = [];
        $all = 0;

        for ($i = 0; $i <= $now->hour; $i++) {
            $times[HelperService::formatHour($i)] = 0;
        }

        $query->each(function ($stat) use (&$times) {
            /** @var DeviceStatistic $stat */
            $times[$stat->start->format('H')] += $stat->start->diffInMinutes($stat->end);
        });

        $keys = [];
        $data = [];
        foreach ($times as $key => $time) {
            $keys[] = "$key:00";
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
    }

    /**
     * Получение статистики онлайна по дням
     * @param UserDevice $device
     * @param int $day
     * @return array
     */
    private function getDayStat(UserDevice $device, int $days): array
    {
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

        $times[Carbon::now()->format('d.m')] = 0;

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
    }
}
