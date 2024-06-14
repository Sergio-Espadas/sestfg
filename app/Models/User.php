<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'apellido_1',
        'apellido_2',
        'email',
        'dni',
        'password',
        'id_tarifa',
        'cupos_clases',
        'id_rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'id_usuario', 'id');
    }

    public function tarifa(): BelongsTo
    {
        return $this->belongsTo(Tarifa::class, 'id_tarifa');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'id_rol');
    }

    public function hasTarifa(): bool
    {
        // Verificar si el usuario tiene una tarifa asignada
        return $this->id_tarifa !== null;
    }

    public function hasCuposClase(): bool
    {
        // Verificar si el usuario tiene cupos disponibles para reservar una clase
        return $this->cupos_clases > 0;
    }

    public function asignarCuposClasesDesdeTarifa($idUsuario, $idTarifa)
    {
        // Buscar el usuario
        $usuario = User::findOrFail($idUsuario);

        // Buscar la tarifa
        $tarifa = Tarifa::find($idTarifa);

        // Verificar si el usuario y la tarifa existen
        if ($usuario && $tarifa) {
            // Asignar la capacidad de la tarifa al usuario
            $usuario->cupos_clases = $tarifa->num_clases;
            $usuario->save();
        }
    }
    
}