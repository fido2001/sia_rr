<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['tanggal', 'akun_id', 'nom_debit', 'nom_kredit', 'keterangan'];

    public function akun()
    {
        return $this->belongsTo('App\Akun', 'akun_id', 'id');
    }
}
