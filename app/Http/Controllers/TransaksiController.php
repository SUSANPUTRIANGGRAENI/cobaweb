<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\CabangToko;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() {
    $data['transaksi'] = Transaksi::with(['produk', 'cabangToko', 'user'])->get();
    return view('transaksi.index', $data);
}


    public function create()
    {
        $data['produk'] = Produk::pluck('nama', 'id');
        $data['cabang_toko'] = Cabang::pluck('nama', 'id');
        $data['users'] = User::pluck('name', 'id');
        return view('transaksi.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'cabang_id' => 'required|exists:cabang_toko,id',
            'users_id' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);

        Transaksi::create($validated);

        $notification = [
            'message' => 'Transaksi berhasil ditambahkan',
            'alert-type' => 'success'
        ];

        return redirect()->route('transaksi.index')->with($notification);
    }

    public function edit(string $id)
    {
        $data['transaksi'] = Transaksi::findOrFail($id);
        $data['produk'] = Produk::pluck('nama', 'id');
        $data['cabangToko'] = Cabang::pluck('nama', 'id');
        $data['users'] = User::pluck('name', 'id');
        return view('transaksi.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'cabang_id' => 'required|exists:cabang_toko,id',
            'users_id' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksi->update($validated);

        $notification = [
            'message' => 'Transaksi berhasil diperbarui',
            'alert-type' => 'success'
        ];

        return redirect()->route('transaksi.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        $notification = [
            'message' => 'Transaksi berhasil dihapus',
            'alert-type' => 'success'
        ];

        return redirect()->route('transaksi.index')->with($notification);
    }
}