<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarifa
 *
 * @property $id
 * @property $name
 * @property $price
 * @property $num_clases
 * @property $fecha_inicio
 * @property $fecha_fin
 * @property $created_at
 * @property $updated_at
 *
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarifa extends Model
{
    protected $perPage = 20;

    protected $fillable = ['name', 'price', 'num_clases'];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'id_tarifa');
    }
}