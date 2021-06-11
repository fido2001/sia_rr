@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Jurnal Umum</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Jurnal Umum</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="card col-md-12">
            <div class="card-body">
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
                <h4 class="card-title">Jurnal Umum</h4>
                <a href="{{ route('jurnal.create')}}"><button class="btn btn-primary">Tambah Data</button></a>
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th>No.</th> --}}
                                <th style="width: 10%">Tanggal</th>
                                <th style="width: 25%">Rekening</th>
                                <th style="width: 25%">Keterangan</th>
                                <th style="width: 20%">Debit</th>
                                <th style="width: 20%">Kredit</th>

                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jurnals as $no => $jurnal)
                            <tr>
                                {{-- <td>{{ $no+1 }}</td> --}}
                                <td>{{ $jurnal->tanggal }}</td>
                                @if ($jurnal->debit_id != null)
                                <td>{{ $jurnal->debit->kode }} - {{ $jurnal->debit->nama_akun }}</td>
                                @else
                                <td>{{ $jurnal->kredit->kode }} - {{ $jurnal->kredit->nama_akun }}</td>
                                @endif
                                <td>{{ $jurnal->keterangan }}</td>
                                @if ($jurnal->nom_debit != null)
                                <td>{{ $jurnal->nom_debit }}</td>
                                @else
                                <td>-</td>
                                @endif
                                @if ($jurnal->nom_kredit != null)
                                <td>{{ $jurnal->nom_kredit }}</td>
                                @else
                                <td>-</td>
                                @endif
                                {{-- <td>
                                    <a href="{{ route('akun.edit', $akun->id) }}" class="badge badge-info">Edit</a>
                                    <a href="#" data-id="{{ $akun->id }}" class="badge badge-danger sa-params">
                                        <form action="{{ route('akun.destroy', $akun->id) }}" id="delete{{ $akun->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        Hapus
                                    </a>
                                </td> --}}
                            </tr>
                            @empty
                            <div class="alert alert-warning show fade">
                                <div class="alert-body">
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