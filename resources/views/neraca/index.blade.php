@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Neraca</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Neraca</li>
            </ol>
        </div>
    </div>
                
    <div class="row">
    <!-- Column -->
        <div class="card col-md-12">
            <div class="card-body">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Neraca</h4>
                    </div>
                    <div class="table-responsive m-t-10">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nomor Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="2" class="text-center">Neraca Saldo</th>
                                    <th colspan="2" class="text-center">Laba Rugi</th>
                                    <th colspan="2" class="text-center">Neraca</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $c1=0;
                                    $c2=0;
                                    $c3=0;
                                    $c4=0;
                                    $c5=0;
                                    $c6=0;
                                @endphp
                                @forelse ($akuns as $akun)
                                    @php 
                                        $saldo = 0 ;
                                        $saldo2 = 0 ;
                                    @endphp
                                    @foreach($akun->jurnal as $jurnal)
                                        @php
                                            $saldo = $saldo + $jurnal->nom_debit - $jurnal->nom_kredit ;
                                            $saldo2 = $saldo*-1 ;
                                        @endphp
                                    @endforeach
                                <tr>
                                    <td>{{ $akun->kode }}</td>
                                    <td>{{ $akun->nama_akun }}</td>
                                    @if($saldo > 0)
                                    <td>Rp. {{ number_format($saldo,0,',','.') }}</td> @php $c1=$c1+$saldo; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    @if($saldo < 0)
                                    <td>Rp. {{ number_format($saldo2,0,',','.') }}</td> @php $c2=$c2+$saldo2; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    @if($akun->kode >= 4000)
                                        @if($saldo > 0)
                                        <td>Rp. {{ number_format($saldo,0,',','.') }}</td> @php $c3=$c3+$saldo; @endphp
                                        @else
                                        <td></td>
                                        @endif
                                    @else
                                    <td></td>
                                    @endif
                                    @if($akun->kode >= 4000)
                                        @if($saldo < 0)
                                        <td>Rp. {{ number_format($saldo2,0,',','.') }}</td> @php $c4=$c4+$saldo2; @endphp
                                        @else
                                        <td></td>
                                        @endif
                                    @else
                                    <td></td>
                                    @endif
                                    @if($akun->kode < 4000)
                                        @if($saldo > 0)
                                        <td>Rp. {{ number_format($saldo,0,',','.') }}</td> @php $c5=$c5+$saldo; @endphp
                                        @else
                                        <td></td>
                                        @endif
                                    @else
                                    <td></td>
                                    @endif
                                    @if($akun->kode < 4000)
                                        @if($saldo < 0)
                                        <td>Rp. {{ number_format($saldo2,0,',','.') }}</td> @php $c6=$c6+$saldo2; @endphp
                                        @else
                                        <td></td>
                                        @endif
                                    @else
                                    <td></td>
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
                            <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Rp. {{ number_format($c1,0,',','.') }}</td>
                                    <td>Rp. {{ number_format($c2,0,',','.') }}</td>
                                    <td>Rp. {{ number_format($c3,0,',','.') }}</td>
                                    <td>Rp. {{ number_format($c4,0,',','.') }}</td>
                                    <td>Rp. {{ number_format($c5,0,',','.') }}</td>
                                    <td>Rp. {{ number_format($c6,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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