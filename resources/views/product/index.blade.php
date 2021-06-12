@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">List Produk</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">List Produk</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="min-height: 85vh">
                    <div class="card-header bg-white">
                        <form action="{{ route('products.index') }}" method="get">
                            <div class="row">  
                                <div class="col"><h4 class="font-weight-bold">List Produk</h4></div>
                                <div class="col"><input type="text" name="search"
                                        class="form-control form-control-sm col-sm-10 float-right"
                                        placeholder="Cari Produk..." onblur="this.form.submit()">
                                </div>
                                <div class="col-sm-2"><a href="{{ url('/products/create')}}"
                                        class="btn btn-primary btn-sm float-right btn-block">Tambah Produk</a>
                                </div>
                            </div>
                        </form>
                    </div>
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
                        <div class="row">
                            @forelse ($products as $product)
                            <div class="col-sm-3">
                                <div class="card mb-3">
                                    <div class="view overlay">
                                        <img class="card-img-top gambar" src="{{ $product->image }}" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center font-weight-bold"
                                            style="text-transform: capitalize;">
                                            {{ Str::words($product->name,6) }}</h5>
                                        <p class="card-text text-center">Rp. {{ number_format($product->price,2,',','.') }}
                                        </p>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-primary btn-block btn-sm">Details</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <div class="alert alert-warning alert-dismissible show fade">
                                    <div class="alert-body">
                                        <strong>Belum ada data produk</strong>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div>{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('style')
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

    </style>
    @endpush