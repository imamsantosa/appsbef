<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = "kehadiran";

    protected $fillable = ['data_peserta_id', 'kehadiran'];
}
