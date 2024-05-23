<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transactions = Transaction::all();

        return view('trans', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masters = Master::all();

        // Mendapatkan nilai x terakhir dari field kode_transaksi pada tabel transactions
        $lastTransactionCode = Transaction::max('kode_transaksi');

        // Mengekstrak angka x dari nilai terakhir
        $lastNumber = intval(substr($lastTransactionCode, 2));

        // Menambahkan 1 untuk mendapatkan nilai baru
        $newNumber = $lastNumber + 1;

        // Membuat default value dengan format "T-x"
        $defaultValue = "T-" . $newNumber;

        return view('createtrans', [
            'masters' => $masters,
            'default_value' => $defaultValue,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi custom untuk memastikan jumlah beli tidak melebihi stok
        $validatedData = $request->validate([
            'kode_transaksi' => 'required',
            'kode_product' => 'required',
            'jumlah_beli' => 'required',
            'total_harga' => 'required',
            'tanggal' => 'required',
        ]);

        // Membuat transaksi dengan data yang sudah divalidasi
        Transaction::create($validatedData);

        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $masters = Master::all();

        return view('edittrans', [
            'transaction' => $transaction,
            'masters' => $masters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate(([
            'kode_transaksi' => 'required',
            'kode_product' => 'required',
            'jumlah_beli' => 'required',
            'total_harga' => 'required',
            'tanggal' => 'required',
        ]));

        Transaction::where('id', $transaction->id)->update($validatedData);

        return redirect('/transaction');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);
        return redirect('/transaction');
    }

    public function report()
    {
        $masters = Master::all();
        $transactions = Transaction::all();

        return view('report', [
            'transactions' => $transactions,
            'masters' => $masters,
        ]);
    }
}
