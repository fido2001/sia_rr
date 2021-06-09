<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = ['tanggal', 'debit_id', 'nom_debit', 'kredit_id', 'nom_kredit', 'keterangan'];

    public function debit()
    {
        return $this->belongsTo('App\Akun', 'debit_id', 'id');
    }

    public function kredit()
    {
        return $this->belongsTo('App\Akun', 'kredit_id', 'id');
    }
}
