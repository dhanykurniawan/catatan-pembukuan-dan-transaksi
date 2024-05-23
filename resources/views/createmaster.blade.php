@extends('template')

@section('container')
<h4 class="card-title">Add New Master Product</h4>

<a href="/master" class="btn btn-warning">Back to Product Master List</a>

<div class="page-header">
    <div class="row  col-12">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body p-0 mt-4">
                    <form action="/master" method="post" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode">Product Code</label>
                            <input type="text" class="form-control text-dark @error('kode') is-invalid @enderror" id="kode" name="kode" placeholder="ex. P-1" value="{{ old('kode', $default_value) }}" autocomplete="off" readonly>
                            @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Product Name</label>
                            <input type="text" class="form-control text-white @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="ex. Laptop ..." value="{{ old('nama') }}" autocomplete="off" autofocus>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan">Unit of Measurement</label>
                            <select class="form-control text-white @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan') }}">
                                <option class="text-white">--- Select unit of measurement ---</option>
                                <option value="Pcs" class="text-white">Pcs</option>
                                <option value="Pack" class="text-white">Pack</option>
                            </select>
                            @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Quantity of Stock</label>
                            <input type="number" class="form-control text-white @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="ex. 10" value="{{ old('stock') }}">
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_jual_satuan">Unit Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white">Rp</span>
                                </div>
                                <input type="number" class="form-control text-white @error('harga_jual_satuan') is-invalid @enderror" id="harga_jual_satuan" name="harga_jual_satuan" placeholder="ex. 5000000" value="{{ old('harga_jual_satuan') }}">
                                @error('harga_jual_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Product Image</label>
                            <input type="file" name="gambar" id="gambar" class="form-control text-white @error('gambar') is-invalid @enderror">
                            @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>







                        <button type="submit" class="btn btn-primary mt-4 container-fluid py-2">Save New
                            Product</button>
                        <!-- <button class="btn btn-dark">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection