@extends('backend.app')

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">List Produk</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">List Produk</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Produk</h4>
                    <form action="{{ route('products.destroy', $product->id ) }}" method="POST">
                        
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm float-right"
                            onclick="return confirm('Apakah anda yakin menghapus data ini ?');">Hapus Produk</button>
                    </form>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
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
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="{{ $product->qty }}">
                        <div class="form-group">
                            <label for="product">Nama Produk</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Gambar Produk</label>
                                    <div>
                                        <div class="custom-file">
                                            <br>
                                            <input name="image" id="image" type="file" class="custom-file-input" style="opacity: 100"
                                                accept="image/*"
                                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 5px"><img id="output" src="" class="img-fluid"></div>
                                    @if($product->image)
                                    <img src="{{asset($product->image)}}" class="img-fluid" id="preview">
                                    @endif
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="qty">Kuantitas</label>
                                    <input type="number" class="form-control" name="qty" value="{{ old('qty', $product->qty) }}" disabled>
                                    @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="addQty">Tambah / Kurang Kuantitas </label>
                                    <input type="number" class="form-control" name="addQty" value="{{ old('addQty') }}"
                                        placeholder="Gunakan angka positif untuk menambahkan dan angka negatif untuk mengurangi stok">
                                    @if(Session::has('errorQty'))
                                    <small class="text-danger font-weight-bold">
                                        {{ Session('errorQty') }}
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" cols="20" rows="10"
                                class="form-control">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Edit Produk</button>
                        </div>
                    </form>
                    <H4>Product History</H4>
                    <table class="table" id="dtMaterialDesignExample">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Updated By</th>
                                <th>Qty Before</th>
                                <th>Qty Added/Reduce</th>
                                <th>Qty</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->qtyChange}}</td>
                                <td>{{$item->qty + $item->qtyChange}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>{{$item->tipe}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection

@push('after-js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
@endpush