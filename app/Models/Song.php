<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory, SoftDeletes; // php rrait

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }
    
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function getDurationToStringAttribute() {
        $minute = (int) ($this->duration / 60);
        $second = $this->duration % 60;
        $second = Str::padLeft($second, 2, '0');
        return "{$minute}:{$second}";
    }

    // protected $table = 'table' -> if you name the table that's not match
}
