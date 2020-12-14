<?php

namespace App\Services;

class HelperService
{
    public static function formatHour(int $hour)
    {
        if ($hour < 10) {
            return '0'.$hour;
        }

        return $hour;
    }
}
