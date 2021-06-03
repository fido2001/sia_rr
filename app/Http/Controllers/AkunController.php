<?php

namespace App\Http\Controllers;

use App\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAkun = Akun::get();
        return view('akun.index', compact('dataAkun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        Akun::create([
            'kode' => $request->kode,
            'nama_akun' => $request->nama_akun
        ]);
        return redirect()->route('akun.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kode' => 'required|max:4|regex:/^[0-9]*$/',
                'nama_akun' => 'required|max:30'
            ],
            [
                'kode.required' => 'Data tidak boleh kosong, harap diisi',
                'kode.max' => 'Maksimal 4 karakter',
                'kode.regex' => 'Hanya boleh diisi angka',
                'nama_akun.required' => 'Data tidak boleh kosong, harap diisi',
                'nama_akun.max' => 'Maksimal 30 karakter',
            ]
        );
        Akun::where('id', $id)->update([
            'kode' => $request->kode,
            'nama_akun' => $request->nama_akun
        ]);
        return redirect()->route('akun.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Akun::destroy($id);
        return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus');
    }

    private function validation(Request $request)
    {
        $validation = $request->validate(
            [
                'kode' => 'required|max:4|regex:/^[0-9]*$/|unique:akuns',
                'nama_akun' => 'required|max:30'
            ],
            [
                'kode.required' => 'Data tidak boleh kosong, harap diisi',
                'kode.max' => 'Maksimal 4 karakter',
                'kode.regex' => 'Hanya boleh diisi angka',
                'kode.unique' => 'Kode sudah ada, silakan ganti',
                'nama_akun.required' => 'Data tidak boleh kosong, harap diisi',
                'nama_akun.max' => 'Maksimal 30 karakter',
            ]
        );
    }
}
