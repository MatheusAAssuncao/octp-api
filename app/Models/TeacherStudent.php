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
        'id_required_anamnesis',
        'id_uploaded_anamnesis',
        'status',
    ];
    protected $hidden = ['id', 'id_teacher', 'id_student', 'created_at', 'updated_at'];
    protected $with = array('teacher');

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher', 'id')->select(
            ['id', 'name', 'media_facebook', 'media_instagram', 'media_whatsapp', 'genre'
        ]);
    }

    public static function getAnamnesisInfo($id_required_anamnesis = null, $id_uploaded_anamnesis = null)
    {
        $anm['id_required_anamnesis'] = $id_required_anamnesis;
        $anm['url_required_anamnesis'] = null;
        $anm['description_required_anamnesis'] = null;
        $anm['id_uploaded_anamnesis'] = $id_uploaded_anamnesis;
        $anm['url_uploaded_anamnesis'] = null;
        $anm['description_uploaded_anamnesis'] = null;

        if ($anm['id_required_anamnesis']) {
            $_file = File::findOrFail($anm['id_required_anamnesis']);
            $anm['url_required_anamnesis'] = env('APP_URL').'storage/'.$_file->path;
            $anm['description_required_anamnesis'] = $_file->description;
        }
        
        if ($anm['id_uploaded_anamnesis']) {
            $_file = File::findOrFail($anm['id_uploaded_anamnesis']);
            $anm['url_uploaded_anamnesis'] = env('APP_URL').'storage/'.$_file->path;
            $anm['description_uploaded_anamnesis'] = $_file->description;
        }

        return $anm;
    }

    public function setNotesAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['notes'] = mb_strtoupper($value, $encoding);
    }
}