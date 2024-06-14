<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clase
 *
 * @property $id
 * @property $id_aula
 * @property $id_trabajo
 * @property $fecha
 * @property $hora
 * @property $created_at
 * @property $updated_at
 *
 * @property Aula $aula
 * @property Trabajo $trabajo
 * @property Reserva[] $reservas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clase extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_aula', 'id_trabajo', 'fecha', 'hora'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aula()
    {
        return $this->belongsTo(\App\Models\Aula::class, 'id_aula', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajo()
    {
        return $this->belongsTo(\App\Models\Trabajo::class, 'id_trabajo', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservas()
    {
        return $this->hasMany(\App\Models\Reserva::class, 'id', 'id_clase');
    }
    
    public function getNumeroReservasAttribute()
    {
        return Reserva::where('id_clase', $this->id)->count();
    }

}