<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Aula
 *
 * @property $id
 * @property $nombre
 * @property $capacidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Clase[] $clases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Aula extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'capacidad'];

    /**
     * Get the clases for the aula.
     */
    public function clases()
    {
        return $this->hasMany(Clase::class, 'id_aula', 'id');
    }
}