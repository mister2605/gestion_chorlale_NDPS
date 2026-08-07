<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChantPupitre extends Pivot
{
    protected $appends = ['audio_url'];

    protected function audioUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->audio_path ? asset('storage/'.$this->audio_path) : null,
        );
    }
}
