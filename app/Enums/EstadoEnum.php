<?php
namespace App\Enums;

enum EstadoEnum: string
{
    case A = 'pendiente';
    case B = 'en_proceso';
    case C = 'finalizada';

    public function toString(): string
    {
        return match ($this) {
            self::A => 'Pendiente',
            self::B => 'En Proceso',
            self::C => 'Finalizo',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::A => 'error',
            self::B => 'gray',
            self::C => 'primary',
        };
    }
}
