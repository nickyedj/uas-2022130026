<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_title',
        'artist_id',
        'song_id',
        'release_date',
        'image'
    ];

    public function songs(){
        return $this->hasMany(Song::class);
    }

    public function artist(){
        return $this->belongsTo(Artist::class);
    }
}
