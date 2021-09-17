<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';
    protected $fillable = [
        'id_user',
        'name',
        'resume',
        'content',
        'status',
    ];

    public static function getHtml($name) {
        return Storage::disk('local')->get($name . ".html");
    }
}
