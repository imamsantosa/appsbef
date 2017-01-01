<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPeserta extends Model
{
    protected $table  = 'status_peserta';
    protected $fillable = ['nama'];
}
