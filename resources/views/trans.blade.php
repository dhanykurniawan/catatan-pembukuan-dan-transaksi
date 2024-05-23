@extends('template')

@section('container')
<h4 class="card-title">Transactions History</h4>

<a href="/transaction/create" class="btn btn-primary">Add new Transaction</a>

<div class="table-responsive mt-4">
    <table class="table">
        <thead>
            <tr>
                <th class="text-white">TRANSACTION CODE</th>
                <th class="text-white">PRODUCT NAME</th>
                <th class="text-white">QUANTITY</th>
                <th class="text-white">TOTAL PRICE</th>
                <th class="text-white">DISCOUNT</th>
                <th class="text-white">TOTAL SALES</th>
                <th class="text-white">DATE OF TRANSACTION</th>
                <th class="text-white">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <th class="text-white">{{ $transaction->kode_transaksi }}</th>
                <td class="text-white">
                    @php
                    $product = \App\Models\Master::where('kode', $transaction->kode_product)->first();
                    @endphp
                    {{ $product ? $product->nama : 'Product Not Found' }}
                </td>

                <td class="text-white">{{ $transaction->jumlah_beli }}</td>
                <td class="text-white">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                <td class="text-white">
                    @if($transaction->jumlah_beli > 10)
                    <?php $diskon = (5 / 100) * $transaction->total_harga; ?>
                    Rp {{ number_format($diskon, 0, ',', '.') }}
                    @else
                    <span>Rp 0</span>
                    @endif
                </td>
                <td class="text-success">
                    @if($transaction->jumlah_beli > 10)
                    <?php $diskon = (5 / 100) * $transaction->total_harga; ?>
                    <?php $total_penjualan =  $transaction->total_harga - $diskon ?>
                    <span class="badge badge-outline-success">
                        Rp {{ number_format($total_penjualan, 0, ',', '.') }}
                    </span>
                    @else
                    <span class="badge badge-outline-success">
                        <?= "Rp " . number_format($transaction->total_harga, 0, ',', '.') ?>
                    </span>
                    @endif
                </td>
                <td class="text-white">
                    {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                </td>
                <td class="d-flex g-2">
                    <a href="/transaction/{{ $transaction->id }}/edit" class="btn btn-info mr-1">Edit</a>
                    <form action='/transaction/{{ $transaction->id }}' method='post'>
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