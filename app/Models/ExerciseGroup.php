<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'id_train',
        'order',
    ];

    protected $with = array('exercise_details');

    public static $groupTypes = ['TRADICIONAL', 'BI-SET', 'TRI-SET', 'DROP-SET', 'TEXTO LIVRE'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->orderBy('order');
        });
    }

    public function exercise_details()
    {
        return $this->hasMany(ExerciseDetail::class, 'id_exercise_group', 'id');
    }

    public function setNameAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['name'] = mb_strtoupper($value, $encoding);
    }

    public function setTypeAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['type'] = mb_strtoupper($value, $encoding);
    }
}
