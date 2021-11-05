<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = "exercises";
    protected $fillable = [
        'name',
        'description',
        'id_muscle_group',
        'id_equipment',
        'id_user',
        'url',
    ];
    
    protected $with = array('musclegroup', 'equipment');

    protected $hidden = ['created_at', 'updated_at'];

    public function setNameAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['name'] = mb_strtoupper($value, $encoding);
    }

    public function setDescriptionAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['description'] = mb_strtoupper($value, $encoding);
    }

    public function musclegroup()
    {
        return $this->belongsTo(MuscleGroup::class, 'id_muscle_group', 'id')->select(
            ['id', 'name']
        );
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'id_equipment', 'id')->select(
            ['id', 'name']
        );
    }
}
