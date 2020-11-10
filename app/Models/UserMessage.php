<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMessage
 *
 * @property int $id
 * @property int $user_id
 * @property int $device_id
 * @property string $message
 * @property int $read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMessage whereUserId($value)
 * @mixin \Eloquent
 */
class UserMessage extends Model
{
    use HasFactory;
}
