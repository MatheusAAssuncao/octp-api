<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'break',
        'id_card',
    ];
    protected $with = array('exercise_groups');

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->orderBy('name');
        });
    }

    public function exercise_groups()
    {
        return $this->hasMany(ExerciseGroup::class, 'id_train', 'id');
    }

    public function setNameAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['name'] = mb_strtoupper($value, $encoding);
    }
}
