@extends('template')

@section('container')
<h4 class="card-title">Add New Transaction</h4>

<a href="/transaction" class="btn btn-warning">Back to Transactions History</a>

<div class="page-header">
    <div class="row  col-12">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body p-0 mt-4">
                    <form action="/transaction" method="post" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_transaksi">Transaction Code</label>
                            <input type="text" class="form-control text-dark @error('kode_transaksi') is-invalid @enderror" id="kode_transaksi" name="kode_transaksi" placeholder="ex. T-1" value="{{ old('kode_transaksi', $default_value) }}" autocomplete="off" readonly>
                            @error('kode_transaksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_product">Product Name</label>
                            <select class="form-control text-white @error('kode_product') is-invalid @enderror" id="kode_product" name="kode_product" onchange="updateMaxQuantity()" autofocus>
                                <option value="">--- Select name of product ---</option>
                                @foreach($masters as $master)
                                <option value="{{ $master->kode }}" data-price="{{ $master->harga_jual_satuan }}" data-max="{{ $master->stock }}" class="text-white">{{ $master->nama }}</option>
                                @endforeach
                            </select>
                            @error('kode_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah_beli">Quantity</label>
                            <input type="number" class="form-control text-white @error('jumlah_beli') is-invalid @enderror" id="jumlah_beli" name="jumlah_beli" placeholder="ex. 3" value="{{ old('jumlah_beli') }}" autocomplete="off" onchange="updateTotalPrice()" max="">
                            @error('jumlah_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="total_harga">Total Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white">Rp</span>
                                </div>
                                <input type="number" class="form-control text-dark @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" placeholder="ex. 5000000" value="{{ old('total_harga') }}" readonly>
                                @error('total_harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Date of Transaction</label>
                            <input type="date" class="form-control text-white @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="ex. 3" value="{{ old('tanggal') ? old('tanggal') : date('Y-m-d') }}" autocomplete="off">
                            @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>














                            @enderror

                        </div>


                        <button type="submit" class="btn btn-primary mt-4 container-fluid py-2">Save New
                            Transaction</button>
                        <!-- <button class="btn btn-dark">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection