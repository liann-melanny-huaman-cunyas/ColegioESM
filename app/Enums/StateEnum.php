<?php
namespace App\Enums;

enum StateEnum: string
{
    case DEFINITIVA = 'DEFINITIVA';
    case TRASLADADO = 'TRASLADADO';

    public function toString(): string
    {
        return match ($this) {
            self::DEFINITIVA => 'Definitivo',
            self::TRASLADADO => 'Trasladado',
        };
    }
}
