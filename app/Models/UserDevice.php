<?php

namespace App\Models;

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
 */
class UserDevice extends Model
{
    use HasFactory;
}
