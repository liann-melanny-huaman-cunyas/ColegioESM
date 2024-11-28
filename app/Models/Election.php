<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'año_academico',
        'estado'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'elections_id');
    }

    // Scope para elecciones en proceso
    public function scopeInProgress($query)
    {
        return $query->where('estado', 'en_proceso');
    }

    // Scope para elecciones de un año académico
    public function scopeByAcademicYear($query, $year)
    {
        return $query->where('año_academico', $year);
    }
}