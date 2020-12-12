<?php

namespace App\Services;

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

    }

    /**
     * Логика переключения онлайн/офлайн
     * @param UserDevice $device
     * @param bool $online
     * @return bool
     */
    public function trigger(UserDevice $device, bool $online): bool
    {

    }

    /**
     * Формирует и отдает параметры устройства
     * @param UserDevice $device
     * @return array
     */
    public function getPropsDevice(UserDevice $device): array
    {

    }
}
