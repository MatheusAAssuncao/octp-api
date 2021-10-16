<?php

namespace App\Models;

class Student extends User
{
    protected $table = 'user';
    protected $hidden = ['cnpj', 'terms_use', 'password', 'temp_password'];
    protected $with = array('info');

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('type', 'S');
        });
    }

    public function info()
    {
        return $this->hasOne(TeacherStudent::class, 'id_student', 'id');
    }
}
