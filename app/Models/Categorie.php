<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'gender', 'weight', 'event_sportif_id'];
    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

    public function eventSportif()
    {
        return $this->belongsTo(EventSportif::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (Categorie $categorie) {
            $categorie->slug = Str::slug($categorie->name . '-' . $categorie->gender . '-' . $categorie->weight);
        });
    }
}
