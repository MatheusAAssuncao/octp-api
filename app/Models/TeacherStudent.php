<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudent extends Model
{
    use HasFactory;

    protected $table = 'teacher_students';
    protected $fillable = [
        'id_teacher',
        'id_student',
        'type_student',
        'type_contract',
        'notes',
        'require_anamnesis',
        'status',
    ];
    protected $hidden = ['id', 'id_teacher', 'id_student', 'created_at', 'updated_at'];
    protected $with = array('teacher');

    protected $casts = [
        'require_anamnesis' => 'boolean',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher', 'id')->select(
            ['id', 'name', 'media_facebook', 'media_instagram', 'media_whatsapp', 'genre'
        ]);
    }
}