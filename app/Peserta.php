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

    public function dataPeserta()
    {
        return $this->hasOne(DataPeserta::class, 'peserta_id');
    }

    public function comparePassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function resetPassword()
    {
        $this->password = Hash::make("123456");
        $this->save();
    }

    public function changePassword($new)
    {
        $this->password = Hash::make($new);
        $this->save();
    }
}
