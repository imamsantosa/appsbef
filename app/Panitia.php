<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Panitia extends Authenticatable
{
    use Notifiable;

    protected $table = 'panitia';
    protected $fillable = ['username', 'password', 'fullname', 'nomor_telepon', 'role_id'];

    public function role()
    {
        return $this->belongsTo(RolePanitia::class, 'role_id');
    }
}
