<?php

namespace App\Models;

use App\Casts\UserDeviceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserDevice
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $online
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $mac
 * @property string|null $signal
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereSignal($value)
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereType($value)
 */
class UserDevice extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => UserDeviceType::class
    ];

    const TYPE_HEATER = 1;
    const TYPE_SWITCHER = 2;

    public static function getNames()
    {
        return [
            self::TYPE_HEATER => 'Тепловентилятор',
            self::TYPE_SWITCHER => 'Выключатель',
        ];
    }

    public static function getKeys()
    {
        return [
            self::TYPE_HEATER,
            self::TYPE_SWITCHER,
        ];
    }
}
