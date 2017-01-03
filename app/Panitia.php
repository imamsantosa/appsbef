<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Panitia extends Authenticatable
{
    use Notifiable;

    protected $table = 'panitia';
    protected $fillable = ['username', 'password', 'photo', 'panlok_id', 'fullname', 'nomor_telepon', 'role_id'];

    public function role()
    {
        return $this->belongsTo(RolePanitia::class, 'role_id');
    }

    public function panlok()
    {
        return $this->belongsTo(Panlok::class, 'panlok_id');
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
