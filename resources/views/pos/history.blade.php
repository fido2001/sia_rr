@extends('backend.app')

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row" style="margin-top: 15px">
        <div class="col">
            <div class="card" style="min-height: 85vh">
                <div class="card-header bg-white"><h4 class="font-weight-bold">Riwayat Transaksi</h4></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>No</th>
                            <th>Nomor Invoices</th>
                            <th>Admin</th>
                            <th>Bayar</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @foreach ($history as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->invoices_number}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>Rp. {{ number_format($item->pay,2,',','.') }}</td>
                                <td>Rp. {{ number_format($item->total,2,',','.') }}</td>
                            <td class="text-center"><a href="{{url('/transaction/laporan', $item->invoices_number )}}" class="btn btn-primary btn-sm">Detail</a></td>
                            </tr>
                        @endforeach                        
                    </table>
                    <div>{{ $history->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
@endpush