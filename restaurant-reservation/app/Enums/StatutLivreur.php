<?php

namespace App\Enums;

enum StatutLivreur: string // <─ Backed enum (avec valeurs string)
{
    case DISPONIBLE = 'disponible';
    case OCCUPE = 'occupé';
    case EN_PAUSE = 'en_pause'; // Optionnel

    // (Optionnel) Méthode pour récupérer toutes les valeurs
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}