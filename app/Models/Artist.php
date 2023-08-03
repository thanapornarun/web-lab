<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);

    }
}
