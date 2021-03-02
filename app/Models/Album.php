<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function artist()
    {
        // albums.artist_id is the FK column
        return $this->belongsTo(Artist::class);
    }
}
