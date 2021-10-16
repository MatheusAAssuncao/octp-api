<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = [
        'id_user',
        'description',
        'category',
        'path',
        'type',
    ];
    public static $categories = ['ANAMNESE', 'TERMO DE USO', 'PRESCRIÇÃO MÉDICA'];

    public function setDescriptionAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['description'] = mb_strtoupper($value, $encoding);
    }

    public function setCategoryAttribute($value)
    {
        $encoding = mb_internal_encoding();
        $this->attributes['category'] = mb_strtoupper($value, $encoding);
    }
}
