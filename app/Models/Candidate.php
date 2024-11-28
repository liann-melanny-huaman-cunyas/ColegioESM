<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'student_id',
        'frase',
        'simbolo',
        'estado',
        'fecha_inscripcion'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Scope para candidatos activos
    public function scopeActive($query)
    {
        return $query->where('estado', 'activo');
    }
}