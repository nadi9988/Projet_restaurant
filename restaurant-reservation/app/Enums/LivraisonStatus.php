<?php

namespace App\Enums;

enum LivraisonStatus: string // <─ Assurez-vous que c'est un "backed enum" (avec type)
{
    case Pending = 'pending';
    case Shipped = 'shipped';
    case Delivered = 'delivered';

    // Méthode pour récupérer les valeurs
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}