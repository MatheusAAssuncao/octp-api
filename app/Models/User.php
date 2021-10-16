<?php

namespace App\Models;

use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $fillable = [
        'name',
        'email',
        'password',
        'temp_password',
        'cpf',
        'cnpj',
        'phone',
        'media_facebook',
        'media_instagram',
        'media_whatsapp',
        'photo',
        'terms_use',
        'type',
        'genre',
        'status',
        'token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'temp_password'
    ];

    public function photo() {
        return $this->belongsTo(File::class, 'photo', 'id');
    }

    // public function termsUse() {
    //     return $this->belongsTo(File::class, 'id_terms_use', 'id');
    // }

    public function isTeacher() {
        return $this->type == "T";
    }

    public function isStudent() {
        return $this->type == "S";
    }

    public function getDtBornAttribute($value) {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y') : null;
    }

    public function setDtBornAttribute($value) {
        $this->attributes['dt_born'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setTermsUseAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['terms_use'] = mb_strtoupper($value, $encoding);
    }

    public function setNameAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['name'] = mb_strtoupper($value, $encoding);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
