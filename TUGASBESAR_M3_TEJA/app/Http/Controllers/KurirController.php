<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    // Menampilkan seluruh data kurir
    public function index()
    {
        $kurirs = Kurir::orderBy('id_kurir')->get();

        return view('kurir.index', compact('kurirs'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('kurir.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kurir' => 'required|string|max:255|unique:kurir,id_kurir',
            'nama_kurir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jasa_pengiriman' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:Reguler,Express',
        ]);

        Kurir::create($data);

        return redirect()->route('kurir.index')
            ->with('success', 'Data kurir berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(string $id)
    {
        $kurir = Kurir::findOrFail($id);

        return view('kurir.edit', compact('kurir'));
    }

    // Memperbarui data
    public function update(Request $request, string $id)
    {
        $kurir = Kurir::findOrFail($id);

        $data = $request->validate([
            'id_kurir' => 'required|string|max:255|unique:kurir,id_kurir,' . $id . ',id_kurir',
            'nama_kurir' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jasa_pengiriman' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:Reguler,Express',
        ]);

        $kurir->update($data);

        return redirect()->route('kurir.index')
            ->with('success', 'Data kurir berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy(string $id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        return redirect()->route('kurir.index')
            ->with('success', 'Data kurir berhasil dihapus.');
    }
}
