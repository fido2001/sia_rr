@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Buku Besar</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Buku Besar</li>
            </ol>
        </div>
    </div>
    
        
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif
          
    @foreach($akuns as $akun)
    <div class="row">
    <!-- Column -->            
        <div class="card col-md-12">
            <div class="card-body">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">{{ $akun->kode }} {{ $akun->nama_akun }}</h4>
                    </div>
                
                    <div class="table-responsive m-t-10">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Tanggal</th>
                                    <th style="width: 30%">Keterangan</th>
                                    <th style="width: 20%">Debit</th>
                                    <th style="width: 20%">Kredit</th>
                                    <th style="width: 20%">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $saldo = 0 ;
                                $saldo2 = 0 ;
                                @endphp
                                
                                @forelse ($akun->jurnal as $jurnal)
                                <tr>
                                    
                                    <td>{{ $jurnal->tanggal }}</td>
                                    <td>{{ $jurnal->keterangan }}</td>
                                    @if ($jurnal->nom_debit != null)
                                    <td>Rp. {{ number_format($jurnal->nom_debit,2,',','.') }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @if ($jurnal->nom_kredit != null)
                                    <td>Rp. {{ number_format($jurnal->nom_kredit,2,',','.') }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @php
                                        $saldo = $saldo + $jurnal->nom_debit - $jurnal->nom_kredit ;
                                        $saldo2 = $saldo*-1 ;
                                    @endphp
                                    @if($saldo < 0)
                                    <td>Rp. {{ number_format($saldo2,2,',','.') }} </td>
                                    @else
                                    <td>Rp. {{ number_format($saldo,2,',','.') }} </td>
                                    @endif
                                </tr>
                                @empty
                                <div class="alert alert-warning show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        Tidak ada data di bulan ini.
                                    </div>
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('custom-js')
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/sweetalert/sweetalert.min.js"></script>
@endpush

@push('after-js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });
    });
</script>

<script>
    $('.sa-params').click(function(e){
        id = e.target.dataset.id;
        swal({
            title: "Yakin Hapus Data?",
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus ini!",
            cancelButtonText: "Tidak, batalkan!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                $(`#delete${id}`).submit();
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });
</script>
@endpush