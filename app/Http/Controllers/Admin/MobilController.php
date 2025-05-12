<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::paginate(10);
        return view('admin.mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    public function store(Request $req)
    {
        // Validasi input
        $data = $req->validate([
            'nama_mobil'     => 'required|string',
            'jenis_mobil'    => 'required|in:City Car & Hatchback,MPV,Sedan,Sports,SUV',
            'gambar_mobil'   => 'nullable|image',  // Validasi gambar
            'highlight'      => 'nullable|string',
            'deskripsi'      => 'nullable|string',
            'harga_mulai'    => 'nullable|string',  // Menyesuaikan dengan harga sebagai string
        ]);

        // Cek apakah ada gambar yang diupload
        if ($req->hasFile('gambar_mobil')) {
            // Mendapatkan file gambar
            $file = $req->file('gambar_mobil');

            // Menyimpan gambar di folder public/storage
            $filePath = 'mobil/' . $file->getClientOriginalName();  // Menentukan nama file
            $file->move(public_path('storage/mobil'), $file->getClientOriginalName()); // Memindahkan file

            $data['gambar_mobil'] = $filePath;  // Menyimpan path gambar di database
        }

        // Menyimpan data mobil ke dalam database
        Mobil::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.mobil.index')
                        ->with('success', 'Mobil berhasil ditambahkan');
    }

    public function edit(Mobil $mobil)
    {
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $req, Mobil $mobil)
    {
        // Validasi data yang diterima dari form
        $data = $req->validate([
            'nama_mobil'   => 'required|string',
            'jenis_mobil'  => 'required|in:City Car & Hatchback,MPV,Sedan,Sports,SUV',
            'gambar_mobil' => 'nullable|image',  // Validasi gambar (optional)
            'highlight'    => 'nullable|string',
            'deskripsi'    => 'nullable|string',
            'harga_mulai'  => 'nullable|string',
        ]);

        // Cek apakah ada gambar yang diupload
        if ($req->hasFile('gambar_mobil')) {
            // Menghapus gambar lama jika ada
            if ($mobil->gambar_mobil) {
                Storage::delete('public/'.$mobil->gambar_mobil); // Menghapus gambar lama
            }

            // Menyimpan gambar yang baru ke public/storage/mobil
            $file = $req->file('gambar_mobil');
            $filePath = 'mobil/' . $file->getClientOriginalName();
            $file->move(public_path('storage/mobil'), $file->getClientOriginalName()); // Memindahkan file

            $data['gambar_mobil'] = $filePath; // Menyimpan path gambar baru
        }

        // Memperbarui data mobil
        $mobil->update($data);

        // Redirect ke halaman daftar mobil setelah update
        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diupdate');
    }

    public function destroy(Mobil $mobil)
    {
        // Cek apakah ada gambar yang terkait dengan mobil dan hapus jika ada
        if ($mobil->gambar_mobil) {
            // Hapus file gambar dari storage
            Storage::delete('public/'.$mobil->gambar_mobil);
        }

        // Hapus data mobil dari database
        $mobil->delete();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Mobil dan gambar berhasil dihapus');
    }
}
