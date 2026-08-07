<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChantVersion extends Model
{
    protected $fillable = ['chant_id', 'paroles', 'modifie_par'];

    public function chant(): BelongsTo
    {
        return $this->belongsTo(Chant::class);
    }

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modifie_par');
    }
}
