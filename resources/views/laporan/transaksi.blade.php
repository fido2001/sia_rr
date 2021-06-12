@extends('backend.app')

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row" style="margin-top: 15px">
        <div class="col">
            <div class="card" style="min-height: 85vh">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col"><h4 class="font-weight-bold">Report / Laporan Transaksi</h4></div>
                    <div class="col">
                        {{-- <a class="btn btn-primary float-right btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Print</a> --}}
                        <a href="{{ URL('/transaction/history') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    </div>                 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <table width="100%" class="table table-borderless">
                                <tr>
                                    <td width="38%" class="font-weight-bold">Invoices Number</td>
                                    <td width="2%" class="font-weight-bold">:</td>
                                    <td width="60%" class="font-weight-bold">{{$transaksi->invoices_number}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Admin</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaksi->user->name}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Dibuat Pada</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaksi->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table width="100%" class="table table-borderless">
                                <tr>
                                    <td width="38%">Pembayaran</td>
                                    <td width="2%">:</td>
                                    <td width="60%">Rp. {{ number_format($transaksi->pay,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Total</td>
                                    <td width="2%">:</td>
                                    <td width="60%">Rp. {{ number_format($transaksi->total,2,',','.') }}</td>
                                </tr>                  
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Kuantitas</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi->productTransaction as $index=>$item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->product->name}}</td>
                                            <td>{{$item->qty}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>                               
                            </table>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
@endpush