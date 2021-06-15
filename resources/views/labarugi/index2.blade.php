@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Laporan Laba Rugi</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Laporan Laba Rugi</li>
            </ol>
        </div>
    </div>
    
    
    <div class="row">
    <!-- Column -->            
        <div class="card col-md-12">
            <div class="card-body">
                <div class="card card-outline-info">
                    <div class="row m-t-10">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Filter Laba Rugi</h4>
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
                                        <a href="" onclick="this.href='/labarugi/' + document.getElementById('bulan').value + '/' + document.getElementById('tahun').value" class="btn btn-success"><i class="fa fa-eye"></i> Cari</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Pendapatan</h4>
                    </div>
                    <div class="table-responsive m-t-10">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            @php 
                                $total = 0 ;
                            @endphp
                            <tbody>
                            @foreach($data as $key => $items)
                            @if($items->kode < 6000)
                                @php 
                                $saldo = 0 ;
                                $saldo2 = 0 ;
                                @endphp
                                
                                @foreach ($items as $item)
                                    @php
                                    dd($item);
                                        $saldo = $saldo + $item->nom_debit - $item->nom_kredit ;
                                        $saldo2 = $saldo*-1 ;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>{{ $item->nama_akun }}</td>
                                    @if($saldo > 0)
                                    <td>Rp. {{ number_format($saldo,0,',','.') }}</td> @php $total=$total-$saldo; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    @if($saldo < 0)
                                    <td>Rp. {{ number_format($saldo2,0,',','.') }}</td> @php $total=$total+$saldo2; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    <td></td>
                                </tr>
                            @endif    
                            @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Rp. {{ number_format($total,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Biaya</h4>
                    </div>
                
                    <div class="table-responsive m-t-10">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            @php 
                                $total2 = 0 ;
                            @endphp
                            <tbody>
                            @foreach($data as $key => $items)
                            @if($items->kode >= 6000)
                                @php 
                                $saldo = 0 ;
                                $saldo2 = 0 ;
                                @endphp
                                
                                @foreach ($items as $item)
                                    @php
                                        $saldo = $saldo + $item->nom_debit - $item->nom_kredit ;
                                        $saldo2 = $saldo*-1 ;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>{{ $item->nama_akun }}</td>
                                    @if($saldo > 0)
                                    <td>Rp. {{ number_format($saldo,0,',','.') }}</td> @php $total2=$total2+$saldo; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    @if($saldo < 0)
                                    <td>Rp. {{ number_format($saldo2,0,',','.') }}</td> @php $total2=$total2-$saldo2; @endphp
                                    @else
                                    <td></td>
                                    @endif
                                    <td></td> 
                                </tr>
                            @endif    
                            @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Rp. {{ number_format($total2,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Total Laba Rugi</h4>
                    </div>
                
                    <div class="table-responsive m-t-10">
                        <table id="" class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td style="width: 80%">Pendapatan</td>
                                    <td>Rp. {{ number_format($total,0,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Biaya</td>
                                    <td>Rp. {{ number_format($total2,0,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 80%">Laba</td>
                                    <td>Rp. {{ number_format($total-$total2,0,',','.') }}</td>
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