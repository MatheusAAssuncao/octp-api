<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    use HasFactory;

    public static function makePass(){
        $mi = substr(str_shuffle("abcdefghijklmnopqrstuvyxwz"), 0, 3);
        $nu = substr(str_shuffle("0123456789"), 0, 2);
        $si = substr(str_shuffle("@$!%*#?&"), 0, 1);

        return str_shuffle($mi.$nu.$si);
    }
}
