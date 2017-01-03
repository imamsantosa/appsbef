<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expo extends Model
{
    protected $table = 'expo';

    protected $fillable = ['nama', 'content', 'edited_by', 'utara', 'selatan'];
}
