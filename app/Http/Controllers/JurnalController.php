<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->get();
        dd($jurnals);

        return view('jurnal.index', ['jurnals' => $jurnals]);
    }

    public function create()
    {
        $akuns = Akun::all();
        return view('jurnal.add', ['akuns' => $akuns]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'debit_id' => 'required',
                'kredit_id' => 'required',
                'nom_debit' => 'required',
                'nom_kredit' => 'required',
                'keterangan' => 'required',
            ],
            [
                'debit_id.required' => 'Data tidak boleh kosong, harap diisi',
                'kredit_id.required' => 'Data tidak boleh kosong, harap diisi',
                'nom_debit.required' => 'Data tidak boleh kosong, harap diisi',
                'nom_kredit.required' => 'Data tidak boleh kosong, harap diisi',
                'keterangan.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );

        Jurnal::create([
            'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'debit_id' => $request->debit_id,
            'nom_debit' => $request->nom_debit,
            'keterangan' => $request->keterangan,
        ]);

        Jurnal::create([
            'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'kredit_id' => $request->kredit_id,
            'nom_kredit' => $request->nom_kredit,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('jurnal.index')->with('success', 'Data berhasil ditambah');
    }

    public function getJurnal()
    {
    }
}
