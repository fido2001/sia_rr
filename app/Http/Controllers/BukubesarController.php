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
}
