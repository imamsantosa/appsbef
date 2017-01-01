<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Peserta extends Authenticatable
{
    use Notifiable;

    protected $table  = 'peserta';
    protected $fillable = ['username', 'password', 'phone', 'school', 'email', 'fullname', 'photo', 'status_peserta_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function StatusPeserta()
    {
        return $this->belongsTo(StatusPeserta::class);
    }
}
