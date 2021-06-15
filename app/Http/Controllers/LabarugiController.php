<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index()
    {
        $akuns = Akun::where('kode', '>=', 4000)->get();

        return view('labarugi.index', ['akuns' => $akuns]);
    }

    public function getLabarugi($bulan, $tahun)
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
        return view('labarugi.index2', ['data' => $data]);
    }
}
