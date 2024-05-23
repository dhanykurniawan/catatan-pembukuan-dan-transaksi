<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masters = Master::all();
        $transactions = Transaction::all();

        return view('master', [
            'masters' => $masters,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendapatkan nilai x terakhir dari field kode pada tabel masters
        $lastMasterCode = Master::max('kode');

        // Mengekstrak angka x dari nilai terakhir
        $lastNumber = intval(substr($lastMasterCode, 2));

        // Menambahkan 1 untuk mendapatkan nilai baru
        $newNumber = $lastNumber + 1;

        // Membuat default value dengan format "T-x"
        $defaultValue = "P-" . $newNumber;

        return view('createmaster', [
            'default_value' => $defaultValue,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        // return $request->file('gambar')->store('product-images');

        $validatedData = $request->validate([
            'kode' => 'required|unique:masters', // 'masters' adalah nama tabel yang Anda gunakan
            'nama' => 'required',
            'gambar' => 'image|file|max:1024',
            'satuan' => 'required',
            'stock' => 'required',
            'harga_jual_satuan' => 'required',
        ]);


        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('product-images');
        }

        // ddd($validatedData);

        Master::create($validatedData);

        return redirect('/master');
    }

    /**
     * Display the specified resource.
     */
    public function show(Master $master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Master $master)
    {
        return view('editmaster', [
            'master' => $master,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Master $master)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required',
            'stock' => 'required',
            'harga_jual_satuan' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|file|max:1024',
            ]);

            // Pengecekan apakah field gambar di database sebelumnya kosong
            if ($master->gambar) {
                Storage::delete($master->gambar);
            }

            $validatedData['gambar'] = $request->file('gambar')->store('product-images');
        }

        $master->update($validatedData);

        return redirect('/master');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Master $master)
    {
        Master::destroy($master->id);
        return redirect('/master');
    }
}
