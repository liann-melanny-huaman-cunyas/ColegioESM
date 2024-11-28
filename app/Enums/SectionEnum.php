<?php
namespace App\Enums;

enum SectionEnum: string
{
    case A = 'A';
    case B = 'B';
    case C = 'C';

    public function toString(): string
    {
        return match ($this) {
            self::A => 'Seccion A',
            self::B => 'Seccion B',
            self::C => 'Seccion C',
        };
    }
}
