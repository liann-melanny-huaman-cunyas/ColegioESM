<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'classroom_id',
        'dni',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'estado_matricula'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Mutador para nombre completo
    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    // Scope para estado de matrícula
    public function scopeEnRoll($query)
    {
        return $query->where('estado_matricula', 'DEFINITIVA');
    }
}

