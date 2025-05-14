<?php

namespace App\Enums;

enum PaymentMode: string
{
    case ESPECES = 'especes';
    case CARTE = 'carte';
    case EN_LIGNE = 'en_ligne';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}