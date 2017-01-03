<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $fillable = ['kode', 'nama', 'kategori_id', 'universitas_id'];

    public function universitas()
    {
        return $this->belongsTo(Universitas::class);
    }
}
