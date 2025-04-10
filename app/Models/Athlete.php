<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Athlete extends Model
{
    /** @use HasFactory<\Database\Factories\AthleteFactory> */
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'gender', 'weight', 'height'];

    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function photo()
    {
        return $this->morphOne(Photo::class,'photoable');
    }
    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

    public static function boot()
    {
        parent::boot();

        static::creating(function (Athlete $athlete) {
            $athlete->slug = Str::slug($athlete->name . '-' . $athlete->last_name . '@' . $athlete->id);
        });
    }
}
