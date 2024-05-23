@extends('template')

@section('container')
<h4 class="card-title">Product Master</h4>

<a href="/master/create" class="btn btn-primary">Add new Product</a>

<div class="table-responsive mt-4">
    <table class="table">
        <thead>
            <tr>
                <th class="text-white">CODE</th>
                <th class="text-white">NAME</th>
                <th class="text-white">IMAGE</th>
                <th class="text-white">UNIT</th>
                <th class="text-white">STOCK</th>
                <th class="text-white">UNIT PRICE</th>
                <th class="text-white">TOTAL SALES</th>
                <th class="text-white">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masters as $master)
            <tr>
                <th class="text-white">{{ $master->kode }}</th>
                <td class="text-white">{{ $master->nama }}</td>
                <td class="text-white">
                    @if($master->gambar)
                    <a href="{{ asset('storage/' . $master->gambar) }}" target="_blank">
                        <img src="{{ asset('storage/' . $master->gambar) }}" alt="image" />
                    </a>
                    @else
                    <span class="text-danger">Not available</span>
                    @endif
                </td class="text-white">
                <td class="text-white">{{ $master->satuan }}</td>
                <td class="text-white">{{ $master->stock }}</td>
                <td class="text-white">Rp {{ number_format($master->harga_jual_satuan, 0, ',', '.') }}
                </td>
                <td class="text-white">
                    @php
                    $totalJumlahBeli = 0;
                    foreach ($transactions as $transaction) {
                    if ($transaction->kode_product == $master->kode) {
                    $totalJumlahBeli += $transaction->jumlah_beli;
                    }
                    }
                    @endphp
                    {{ $totalJumlahBeli }}
                </td>
                <td class="d-flex g-2">
                    <a href="/master/{{ $master->id }}/edit" class="btn btn-info mr-1">Edit</a>
                    <!-- <a href="/master/{{ $master->id }}/edit" class="btn btn-danger">Delete</a> -->
                    <form action='/master/{{ $master->id }}' method='post'>
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('are u sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection