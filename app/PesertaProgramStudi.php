<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaProgramStudi extends Model
{
    protected $table = 'peserta_program_studi';
    protected $fillable = ['peserta_id', 'program_studi_id', 'urutan'];
}
