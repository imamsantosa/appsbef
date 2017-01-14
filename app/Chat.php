<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable = ['user_id', 'is_panitia', 'expo_id', 'chat', 'date'];

    public function dataUser()
    {
        if($this->is_panitia)
        {
            return $this->belongsTo(Panitia::class, 'user_id');
        }

        return $this->belongsTo(Peserta::class, 'user_id');
    }
}
