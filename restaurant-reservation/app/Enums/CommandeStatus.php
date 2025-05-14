<?php

namespace App\Enums;

enum CommandeStatus: string
{
    case EN_ATTENTE = 'en_attente';
    case CONFIRMEE = 'confirmee';
    case EN_PREPARATION = 'en_preparation';
    case EXPEDIEE = 'expediee';
    case LIVREE = 'livree'; // <-- Le cas manquant
    case ANNULEE = 'annulee';

        // Méthode pour récupérer toutes les valeurs
    public static function values(): array
        {
            return array_column(self::cases(), 'value');
        }
    

    public function label(): string
    {
        return match($this) {
            self::EN_ATTENTE => 'En attente',
            self::CONFIRMEE => 'Confirmée',
            self::EN_PREPARATION => 'En préparation',
            self::EXPEDIEE => 'Expédiée',
            self::LIVREE => 'Livrée', // <-- Libellé français
            self::ANNULEE => 'Annulée'
        };
    }

    public function canTransitionTo(self $status): bool
    {
        return match($this) {
            self::EN_ATTENTE => in_array($status, [self::CONFIRMEE, self::ANNULEE]),
            self::CONFIRMEE => in_array($status, [self::EN_PREPARATION, self::ANNULEE]),
            self::EN_PREPARATION => in_array($status, [self::EXPEDIEE, self::ANNULEE]),
            self::EXPEDIEE => $status === self::LIVREE,
            default => false
        };
    }
}