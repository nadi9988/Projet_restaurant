<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Admin extends Model
{
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';

    protected $fillable = [
        'user_id',
        'role'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accesseurs (Getters)
    public function getRoleAttribute($value)
    {
        $roles = [
            self::ROLE_SUPER_ADMIN => 'Super Administrateur',
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_MANAGER => 'Gestionnaire'
        ];

        return $roles[$value] ?? Str::title(str_replace('_', ' ', $value));
    }

    public function getFullNameAttribute()
    {
        return Str::title($this->user->first_name . ' ' . $this->user->last_name);
    }

    public function getCreationDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    // Mutateurs (Setters)
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = Str::snake(trim($value));
    }

    // Méthodes utilitaires
    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function canManageUsers()
    {
        return in_array($this->role, [self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN]);
    }

    public function canManageContent()
    {
        return $this->role !== self::ROLE_MANAGER;
    }

    public function getInitialsAttribute()
    {
        return Str::upper(
            substr($this->user->first_name, 0, 1) . 
            substr($this->user->last_name, 0, 1)
        );
    }

    public function getLastActivityAttribute()
    {
        return $this->user->last_login_at 
            ? Carbon::parse($this->user->last_login_at)->diffForHumans()
            : 'Jamais connecté';
    }

    // Scopes
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('user', function($q) {
            $q->where('is_active', true);
        });
    }

    public function scopeWithLastLogin($query)
    {
        return $query->addSelect(['last_login_at' => User::select('last_login_at')
            ->whereColumn('id', 'admins.user_id')
            ->latest()
            ->take(1)
        ]);
    }

    // Méthode de vérification des permissions
    public function hasPermission($permission)
    {
        $permissions = [
            self::ROLE_SUPER_ADMIN => ['*'],
            self::ROLE_ADMIN => ['users.read', 'settings.manage'],
            self::ROLE_MANAGER => ['content.manage']
        ];

        return in_array($permission, $permissions[$this->role]) 
            || in_array('*', $permissions[$this->role]);
    }

    // Méthode de mise à jour sécurisée
    public function safeUpdate(array $data)
    {
        if($this->isSuperAdmin() && isset($data['role'])) {
            unset($data['role']);
        }

        return $this->update($data);
    }
}