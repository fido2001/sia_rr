@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Jurnal Umum</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jurnal.index') }}">Jurnal Umum</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Jurnal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jurnal.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Rekening Debit</label>
                                        <select name="debit_id" id="debit_id" class="form-control @error('debit_id') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu Rekening Debit</option>
                                            @foreach ($akuns as $akun)
                                                <option value="{{ $akun->id }}">{{ $akun->kode }} | {{ $akun->nama_akun }}</option>
                                            @endforeach
                                        </select>
                                        @error('debit_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nominal</label>
                                        <input type="number" min="1000" name="nominal" value="{{ old('nominal') }}" class="form-control @error('nom_debit') is-invalid @enderror">
                                        @error('nom_debit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Rekening Kredit</label>
                                        <select name="kredit_id" id="kredit_id" class="form-control @error('kredit_id') is-invalid @enderror">
                                            <option disabled selected>Pilih Salah Satu Rekening Kredit</option>
                                            @foreach ($akuns as $akun)
                                                <option value="{{ $akun->id }}">{{ $akun->kode }} | {{ $akun->nama_akun }}</option>
                                            @endforeach
                                        </select>
                                        @error('kredit_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-pt-20">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror">
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ route('jurnal.index') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
