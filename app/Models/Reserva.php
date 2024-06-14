<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reserva
 *
 * @property $id
 * @property $id_clase
 * @property $id_usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property Clase $clase
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reserva extends Model
{   
    public function scopeOrderByClaseFechaHora($query, $direction = 'asc')
    {
        return $query->select('reservas.*')
            ->join('clases', 'reservas.id_clase', '=', 'clases.id')
            ->orderBy('clases.fecha', $direction)
            ->orderBy('clases.hora', $direction);
    }

    public function scopeOrderByUsuario($query, $column, $direction = 'asc')
    {
        return $query->select('reservas.*')
            ->join('users', 'reservas.id_usuario', '=', 'users.id')
            ->orderBy("users.$column", $direction);
    }

    use HasFactory;

    protected $fillable = [
        'id_clase',
        'id_usuario',
    ];

    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}