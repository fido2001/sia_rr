<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $fillable = ['kode', 'nama_akun'];

    public function jurnal()
    {
        return $this->hasMany('App\Jurnal', 'akun_id');
    }
}
