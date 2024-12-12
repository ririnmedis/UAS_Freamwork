<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\mahasiswa;
use App\Exports\MhsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



class MhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all(); //mengambil semua data dari tabel mahasiswas menggunakan model mahasiswa
        return view('mahasiswa.index', compact('mahasiswas')); //mengirim data ke view
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
        $validated = $request->validate([ //ini buat validasi data 
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
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'npm' => 'required|string|max:15',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->npm = $request->input('npm');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->prodi = $request->input('prodi');
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
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

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'Mhs.xlsx');
    }


}