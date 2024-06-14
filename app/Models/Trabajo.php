<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trabajo
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Clase[] $clases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Trabajo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clases()
    {
        return $this->hasMany(\App\Models\Clase::class, 'id', 'id_trabajo');
    }
    
}
