<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;

class MhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('mahasiswa.create');



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:15',
            'prodi' => 'required|string|max:100',
        ]);

        // Simpan data ke database
        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.create')->with('success', 'Data mahasiswa berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari mahasiswa berdasarkan ID, jika tidak ditemukan, akan menghasilkan error 404
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Menghapus data mahasiswa
        $mahasiswa->delete();

        // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus!');
    }


}