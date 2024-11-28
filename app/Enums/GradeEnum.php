<?php
namespace App\Enums;

enum GradeEnum: string
{
    case FIRST = '1';
    case SECOND = '2';
    case THIRD = '3';
    case FOURTH = '4';
    case FIFTH = '5';

    public function toString(): string
    {
        return match ($this) {
            self::FIRST => 'Primer Grado',
            self::SECOND => 'Segundo Grado',
            self::THIRD => 'Tercer Grado',
            self::FOURTH => 'Cuarto Grado',
            self::FIFTH => 'Quinto Grado',
        };
    }
}
