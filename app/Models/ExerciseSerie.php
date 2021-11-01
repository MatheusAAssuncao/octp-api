<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseSerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_exercise_detail',
        'charge',
        'repetition',
        'order',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->orderBy('order');
        });
    }
}
