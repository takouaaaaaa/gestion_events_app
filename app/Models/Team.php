<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }
    public function logo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
