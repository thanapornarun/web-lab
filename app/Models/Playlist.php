<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Enums\PlaylistAccessibility;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $casts = [
        'accessibility' => PlaylistAccessibility::class,
    ];
    
    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPublic() {
        return $this->accessibility() === PlaylistAccessibility :: PUBLIC;
    }
    
    public function isPrivate() {
        return $this->accessibility() === PlaylistAccessibility :: PRIVATE;
    }

    public function isOwnedBy($user_id) : bool {
        return $this->$user_id === $user_id;
    }

    public function scopePublicList($query, $user_id) {
            return $query->where('accessibility' , PlaylistAccessibility::PUBLIC);
        }

    public function scopeOfUser($query, $user_id) {
        return $query->where('user_id', $user_id);
    }
}
