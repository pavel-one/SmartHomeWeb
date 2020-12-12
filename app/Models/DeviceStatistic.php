<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeviceStatistic
 *
 * @property int $id
 * @property int $device_id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStatistic whereStart($value)
 * @mixin \Eloquent
 */
class DeviceStatistic extends Model
{
    use HasFactory;

    protected $dates = [
        'start',
        'end'
    ];
}
