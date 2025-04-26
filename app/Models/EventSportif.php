<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventSportif extends Model
{
    /** @use HasFactory<\Database\Factories\EventSportifFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function athletes()
    {
        return $this->hasManyThrough(Athlete::class, Categorie::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function logo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function poster()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public static function boot()

    {
        parent::boot();
        static::creating(function (EventSportif $event) {
            $event->slug = Str::slug($event->name);
        });
    }
}
