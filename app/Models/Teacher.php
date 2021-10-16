<?php

namespace App\Models;

class Teacher extends User
{
    protected $table = 'user';
    protected $hidden = ['password', 'temp_password'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type', 'T');
        });
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'teacher_students', 'id_teacher', 'id_student');
    }
}
