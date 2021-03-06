<?php

namespace App\Models;

use App\Casts\UserDeviceType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * App\Models\UserDevice
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property mixed $type
 * @property string|null $mac
 * @property string|null $signal
 * @property int $online
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $power
 * @property \Illuminate\Support\Carbon $last_check
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceStatistic[] $statistic
 * @property-read int|null $statistic_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereLastCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice wherePower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereSignal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUserId($value)
 * @mixin \Eloquent
 */
class UserDevice extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => UserDeviceType::class
    ];

    protected $fillable = [
        'name',
        'power',
        'type',
        'mac',
        'signal'
    ];

    protected $dates = [
        'last_check',
        'created_at',
        'updated_at',
    ];

    public const TABLE = 'user_devices';

    public const TYPE_HEATER = 1;
    public const TYPE_SWITCHER = 2;

    public static function getNames($revert = false)
    {
        $arr = [
            self::TYPE_HEATER => 'Тепловентилятор',
            self::TYPE_SWITCHER => 'Выключатель',
        ];

        if ($revert) {
            $arr = array_flip($arr);
        }

        return $arr;
    }

    public static function getKeys()
    {
        return [
            self::TYPE_HEATER,
            self::TYPE_SWITCHER,
        ];
    }

    public function offline(): bool
    {
        $this->online = false;

        /** @var DeviceStatistic $statistic */
        $statistic = $this->statistic()
            ->whereNull('end')
            ->first();

        if (!$statistic) {
            return false;
        }

        $statistic->end = Carbon::now();

        return $this->save() && $statistic->save();
    }

    public function online(int $signal = 0): bool
    {
        $this->last_check = Carbon::now();
        $this->online = true;
        $this->signal = $signal;

        $statistic = $this->statistic()
            ->whereNull('end')
            ->first();

        if (!$statistic) {
            $statistic = $this->statistic()->create([
                'start' => Carbon::now()
            ]);
        }

        if (!$statistic) {
            return false;
        }

        return $this->save();
    }

    public function statistic(): HasMany
    {
        return $this->hasMany(DeviceStatistic::class, 'device_id', 'id');
    }
}
