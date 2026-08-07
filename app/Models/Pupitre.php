<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pupitre extends Model
{
    protected $fillable = ['nom'];

    public function chants(): BelongsToMany
    {
        return $this->belongsToMany(Chant::class, 'chant_pupitre');
    }

    public function choristes(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
