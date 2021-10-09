<?php

namespace App\Models;

class Student extends User
{
    protected $table = 'user';
    protected $hidden = ['cnpj', 'terms_use', 'id_terms_use'];
    protected $with = array('info');

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type', 'S');
        });
    }

    // public function teacher()
    // {
    //     return $this->BelongsToMany(Teacher::class, 'teacher_students', 'id_student', 'id_teacher');
    // }

    public function info()
    {
        return $this->hasOne(TeacherStudent::class, 'id_student', 'id');
    }
}
