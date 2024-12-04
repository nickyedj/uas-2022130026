<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserListenHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'song_id',
        'listened_at',
    ];

    protected $casts = [
        'listened_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}

