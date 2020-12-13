<?php

namespace App\Services;

use App\Models\DeviceStatistic;
use App\Models\User;
use App\Models\UserDevice;

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
        ]);

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

    public function deviceFactory(int $count = 10): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return UserDevice::factory()
            ->has(
                DeviceStatistic::factory()
                    ->count(100),
                'statistic'
            )
            ->count($count);
    }
}
