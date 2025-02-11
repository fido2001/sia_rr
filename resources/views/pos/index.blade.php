@extends('backend.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 15px">
        <div class="col-md-12">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <form action="{{ url('/transaction') }}" method="get">
                        <div class="row">
                            <div class="col"><input type="text" name="search"
                                    class="form-control form-control-sm col-sm-12 float-right"
                                    placeholder="Cari Produk..." onblur="this.form.submit()"></div>
                            <div class="col-sm-3"><button type="submit"
                                    class="btn btn-primary btn-sm float-right btn-block">Cari Produk</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $product)
                        <div style="height:20%;width: 16.66%;border:1px solid rgb(243, 243, 243)" class="mb-4">
                            <div class="productCard">
                                <div class="view overlay">
                                    <form action="{{url('/transaction/addproduct', $product->id)}}" method="POST">
                                        @csrf
                                        @if($product->qty == 0)
                                        <img class="card-img-top gambar" src="{{ $product->image }}"
                                            alt="Card image cap">
                                        <button class="btn btn-primary btn-sm cart-btn disabled"><i
                                                class="fa fa-cart-plus"></i></button>
                                        @else
                                        <img class="card-img-top gambar" src="{{ $product->image }}"
                                            alt="Card image cap" style="cursor: pointer"
                                            onclick="this.closest('form').submit();return false;">
                                        <button type="submit" class="btn btn-primary btn-sm cart-btn"><i
                                                class="fa fa-cart-plus"></i></button>
                                        @endif
                                    </form>
                                </div>
                                <div class="card-body">
                                    <label class="card-text text-center font-weight-bold"
                                        style="text-transform: capitalize;">
                                        {{ Str::words($product->name,4) }} ({{$product->qty}}) </label>
                                    <p class="card-text text-center">Rp. {{ number_format($product->price,2,',','.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="font-weight-bold">Cart</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow-y:auto;min-height:33vh;max-height:53vh" class="mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Nama Produk</th>
                                    <th width="30%">Kuantitas</th>
                                    <th width="30%" class="text-right">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1
                                @endphp
                                @forelse($cart_data as $index=>$item)
                                <tr>
                                    <td>
                                        <form action="{{url('/transaction/removeproduct',$item['rowId'])}}"
                                            method="POST">
                                            @csrf
                                            {{$no++}} <br><a onclick="this.closest('form').submit();return false;"><i
                                                    class="fa fa-trash" style="color: rgb(134, 134, 134)"></i></a>
                                        </form>
                                    </td>
                                    <td>{{Str::words($item['name'],3)}} <br>Rp.
                                        {{ number_format($item['pricesingle'],2,',','.') }}
                                    </td>
                                    <td class="font-weight-bold">
                                        <form action="{{url('/transaction/decreasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-info"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fa fa-minus"></i></button>
                                        </form>
                                        <a style="display: inline">{{$item['qty']}}</a>
                                        <form action="{{url('/transaction/increasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-primary"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fa fa-plus"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-right">Rp. {{ number_format($item['price'],2,',','.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Empty Cart</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right">Rp.
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        <tr>
                            <th>
                                <form action="{{ url('/transaction') }}" method="get">
                                    PPN 10%
                                    <input style="opacity: 100; position: relative; left: 0px" type="checkbox" {{ $data_total['tax'] > 0 ? "checked" : ""}} name="tax"
                                        value="true" onclick="this.form.submit()">
                                </form>
                            </th>
                            <th class="text-right">Rp.
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th class="text-right font-weight-bold">Rp.
                                {{ number_format($data_total['total'],2,',','.') }}</th>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="{{ url('/transaction/clear') }}" method="POST">
                                @csrf
                                <button class="btn btn-info btn-lg btn-block" style="padding:1rem!important"
                                    onclick="return confirm('Apakah anda yakin ingin meng-clear cart ?');"
                                    type="submit">Kosongkan</button>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn btn-primary btn-lg btn-block"
                                style="padding:1rem!important" href="{{url('/transaction/history')}}" target="_blank">Riwayat</a>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success btn-lg btn-block" style="padding:1rem!important"
                                data-toggle="modal" data-target="#fullHeightModalRight">Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="fullHeightModalRight" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-full-height modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header indigo">
                    <h6 class="modal-title w-100 text-light" id="myModalLabel">Billing Information</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right">Rp.
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        @if($data_total['tax'] > 0)
                        <tr>
                            <th>PPN 10%</th>
                            <th class="text-right">Rp.
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        @endif
                    </table>
                    <form action="{{ url('/transaction/bayar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="oke">Input Nominal</label>
                        <input id="oke" class="form-control" type="number" name="bayar" autofocus />
                    </div>
                    <h3 class="font-weight-bold">Total:</h3>
                    <h1 class="font-weight-bold mb-5">Rp. {{ number_format($data_total['total'],2,',','.') }}</h1>
                    <input id="totalHidden" type="hidden" name="totalHidden" value="{{$data_total['total']}}" />

                    <h3 class="font-weight-bold">Bayar:</h3>
                    <h1 class="font-weight-bold mb-5" id="pembayaran"></h1>

                    <h3 class="font-weight-bold text-primary">Kembalian:</h3>
                    <h1 class="font-weight-bold text-primary" id="kembalian"></h1>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveButton" disabled onClick="openWindowReload(this)">Simpan Transaksi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @push('after-js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(Session::has('error'))
    <script>
        toastr.error(
            'Telah mencapai jumlah maximum Product | Silahkan tambah stock Product terlebih dahulu untuk menambahkan'
        )

    </script>
    @endif

    @if(Session::has('errorTransaksi'))
    <script>
        toastr.error(
            'Transaksi tidak valid | perhatikan jumlah pembayaran | cek jumlah product'
        )

    </script>
    @endif

    @if(Session::has('success'))
    <script>
        toastr.success(
            'Transaksi berhasil | Terimakasih'
        )

    </script>
    @endif

    <script>
        $(document).ready(function () {
            $('#fullHeightModalRight').on('shown.bs.modal', function () {
                $('#oke').trigger('focus');
            });
        });

        oke.oninput = function () {
            let jumlah = parseInt(document.getElementById('totalHidden').value) ? parseInt(document.getElementById('totalHidden').value) : 0;
            let bayar = parseInt(document.getElementById('oke').value) ? parseInt(document.getElementById('oke').value) : 0;
            let hasil = bayar - jumlah;
            document.getElementById("pembayaran").innerHTML = bayar ? 'Rp ' + rupiah(bayar) + ',00' : 'Rp ' + 0 +
                ',00';
            document.getElementById("kembalian").innerHTML = hasil ? 'Rp ' + rupiah(hasil) + ',00' : 'Rp ' + 0 +
                ',00';

            cek(bayar, jumlah);
            const saveButton = document.getElementById("saveButton");   

            if(jumlah === 0){
                saveButton.disabled = true;
            }

        };

        function cek(bayar, jumlah) {
            const saveButton = document.getElementById("saveButton");   

            if (bayar < jumlah) {
                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        }

        function rupiah(bilangan) {
            var number_string = bilangan.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

    </script>

    @endpush

    @push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        .gambar {
            width: 100%;
            height: 175px;
            padding: 0.9rem 0.9rem
        }

        @media only screen and (max-width: 600px) {
            .gambar {
                width: 100%;
                height: 100%;
                padding: 0.9rem 0.9rem
            }
        }

        html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        .cart-btn {
            position: absolute;
            display: block;
            top: 5%;
            right: 5%;
            cursor: pointer;
            transition: all 0.3s linear;
            padding: 0.6rem 0.8rem !important;

        }

        .productCard {
            cursor: pointer;

        }

        .productCard:hover {
            border: solid 1px rgb(172, 172, 172);

        }

    </style>
    <!-- © 2020 Copyright: Tahu Coding -->
    @endpush