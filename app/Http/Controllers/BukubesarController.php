<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BukubesarController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();

        return view('bukubesar.index', ['akuns' => $akuns]);
    }

    public function getBukubesar($bulan, $tahun)
    {
        $data = Jurnal::leftJoin('akuns', 'akuns.id', 'jurnals.akun_id')
            ->whereMonth('jurnals.tanggal', date($bulan))
            ->whereYear('jurnals.tanggal', date($tahun))
            ->select('jurnals.*', 'akuns.kode', 'akuns.nama_akun')
            ->get()
            ->groupBy(function ($val) {
                return $val->nama_akun . '-' . $val->kode;
            });

        // dd($data);
        return view('bukubesar.index2', compact('data'));
    }
}
