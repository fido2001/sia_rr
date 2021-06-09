<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $fillable = ['kode', 'nama_akun'];

    public function debit_akun()
    {
        return $this->hasOne('App\Jurnal', 'debit_id');
    }

    public function kredit_akun()
    {
        return $this->hasOne('App\Jurnal', 'debit_id');
    }
}
