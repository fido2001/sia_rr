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
                <div class="row m-t-10">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Filter Jurnal</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Bulan</label>
                                                <select name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                                    {{-- <option disabled selected>-- Bulan --</option> --}}
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                                @error('bulan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Tahun</label>
                                                <select name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                                @error('tahun')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <a href="" onclick="this.href='/jurnal/' + document.getElementById('bulan').value + '/' + document.getElementById('tahun').value" class="btn btn-success"><i class="fa fa-eye"></i> Cari</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('jurnal.create')}}"><button class="btn btn-primary">Tambah Data</button></a>
                <div class="table-responsive m-t-10">
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
                                
                                <td>{{ $jurnal->tanggal }}</td>
                                
                                <td>{{ $jurnal->akun->kode }} - {{ $jurnal->akun->nama_akun }}</td>
                                
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