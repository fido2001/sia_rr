<?php

namespace App\Http\Controllers;

use App\Akun;
use App\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();

        return view('neraca.index', ['akuns' => $akuns]);
    }
}
