<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Swift_Message;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
    protected $fillable = [
        'to',
        'resume',
        'content',
    ];
}
