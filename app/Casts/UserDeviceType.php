<?php

namespace App\Casts;

use App\Models\UserDevice;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class UserDeviceType implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  UserDevice  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return $model::getNames()[$value] ?? 'Неизвестный тип устройства';
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return $model::getNames(true)[$value];
    }
}
