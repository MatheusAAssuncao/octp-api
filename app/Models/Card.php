<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'id_teacher_student',
        'id_user',
        'dt_end',
        'times',
        'status',
    ];
    protected $with = array('trains');

    public function trains()
    {
        return $this->hasMany(Train::class, 'id_card', 'id');
    }

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

    public function getDtEndAttribute($value) {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    public function setDtEndAttribute($value) {
        $this->attributes['dt_end'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }
}
