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
        $akuns = Akun::where('kode', '>=', 4000 )->get();

        return view('labarugi.index', ['akuns' => $akuns]);
    }
}
