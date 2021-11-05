<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_exercise',
        'id_exercise_group',
        'id_equipment',
        'url',
        'repetition_type',
        'charge_type',
        'series_interval',
        'notes',
    ];

    protected $with = array('exercise', 'exercise_series');

    public static $repetitionTypes = ['REPETIÇÕES', 'MINUTOS', 'SEGUNDOS'];
    public static $chargeTypes = ['KILO', 'LIBRA', 'PESO', 'POR CENTO'];

    public function exercise_series()
    {
        return $this->hasMany(ExerciseSerie::class, 'id_exercise_detail', 'id');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'id_exercise', 'id');
    }

    public function setNotesAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['notes'] = mb_strtoupper($value, $encoding);
    }

    public function setRepetitionTypeAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['repetition_type'] = mb_strtoupper($value, $encoding);
    }

    public function setSeriesTypeAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['series_type'] = mb_strtoupper($value, $encoding);
    }
}
