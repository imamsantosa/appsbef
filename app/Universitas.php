<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    protected $table = 'universitas';
    protected $fillable = ['kode', 'nama'];
}
