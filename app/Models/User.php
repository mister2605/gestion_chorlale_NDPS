<?php

namespace App\Models;

// Illuminate\Foundation\Auth\User as Authenticatable
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qu'on peut remplir en masse (via create()/update()).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // 'maitre_choeur' ou 'choriste'
        'pupitre_id',  // sa voix principale (Soprano, Alto, Ténor, Basse)
    ];

    /**
     * Les attributs à cacher lors de la sérialisation (ex: dans une réponse API).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à convertir automatiquement.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relations ---

    public function pupitre(): BelongsTo
    {
        return $this->belongsTo(Pupitre::class);
    }

    // --- Aides pour les rôles ---

    public function estMaitreDeChoeur(): bool
    {
        return $this->role === 'maitre_choeur';
    }

    public function estChoriste(): bool
    {
        return $this->role === 'choriste';
    }
}
