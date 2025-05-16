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

    public function show(Mobil $mobil)
    {
        return view('admin.mobil.detail', compact('mobil'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    // Proses simpan data mobil
    public function store(Request $req)
    {
        // Validasi input
        $data = $req->validate([
            'nama_mobil' => 'required|string',
            'jenis_mobil' => 'required|in:City Car & Hatchback,MPV,Sedan,Sports,SUV',
            'gambar_mobil' => 'nullable|image',
            'banner_mobil' => 'nullable|image', // Menambahkan validasi untuk banner mobil
            'highlight' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'nullable|string',
            'fitur.*' => 'nullable|string',
            'gambar_fitur.*' => 'nullable|image',
            'warna.*' => 'nullable|string',
            'gambar_warna.*' => 'nullable|image',
        ]);

        // Cek apakah ada gambar yang diupload
        if ($req->hasFile('gambar_mobil')) {
            $file = $req->file('gambar_mobil');
            $filePath = 'mobil/' . $file->getClientOriginalName();
            $file->move(public_path('storage/mobil'), $file->getClientOriginalName());
            $data['gambar_mobil'] = $filePath;
        }

        // Cek apakah ada banner yang diupload
        if ($req->hasFile('banner_mobil')) {
            $bannerFile = $req->file('banner_mobil');
            $bannerPath = 'mobil/banner/' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path('storage/mobil/banner'), $bannerFile->getClientOriginalName());
            $data['banner_mobil'] = $bannerPath;
        }

        // Menyimpan data mobil ke dalam database
        $mobil = Mobil::create($data);

        // Menyimpan fitur mobil
        if ($req->fitur) {
            foreach ($req->fitur as $index => $fitur) {
                if ($fitur) {
                    $gambarFiturPath = null;
                    // Periksa apakah ada file gambar fitur untuk fitur ini
                    if (isset($req->gambar_fitur[$index]) && $req->gambar_fitur[$index]->isValid()) {
                        $file = $req->file('gambar_fitur')[$index];
                        $gambarFiturPath = 'mobil/fitur/' . $file->getClientOriginalName();
                        $file->move(public_path('storage/mobil/fitur'), $file->getClientOriginalName());
                    }
                    $mobil->fiturMobil()->create(['fitur_mobil' => $fitur, 'gambar_fitur_mobil' => $gambarFiturPath]);
                }
            }
        }

        // Menyimpan warna mobil
        if ($req->warna) {
            foreach ($req->warna as $index => $warna) {
                if ($warna) {
                    $gambarWarnaPath = null;
                    // Periksa apakah ada file gambar warna untuk warna ini
                    if (isset($req->gambar_warna[$index]) && $req->gambar_warna[$index]->isValid()) {
                        $file = $req->file('gambar_warna')[$index];
                        $gambarWarnaPath = 'mobil/warna/' . $file->getClientOriginalName();
                        $file->move(public_path('storage/mobil/warna'), $file->getClientOriginalName());
                    }
                    $mobil->warnaMobil()->create(['warna_mobil' => $warna, 'gambar_warna_mobil' => $gambarWarnaPath]);
                }
            }
        }

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambahkan');
    }

    public function edit(Mobil $mobil)
    {
        return view('admin.mobil.edit', compact('mobil'));
    }

    // Proses update data mobil
    public function update(Request $req, Mobil $mobil)
    {
        // Validasi data yang diterima dari form
        $data = $req->validate([
            'nama_mobil' => 'required|string',
            'jenis_mobil' => 'required|in:City Car & Hatchback,MPV,Sedan,Sports,SUV',
            'gambar_mobil' => 'nullable|image',
            'banner_mobil' => 'nullable|image', // Menambahkan validasi untuk gambar banner
            'highlight' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'nullable|string',
        ]);

        // Cek jika ada gambar yang diupload
        if ($req->hasFile('gambar_mobil')) {
            if ($mobil->gambar_mobil) {
                Storage::delete('public/' . $mobil->gambar_mobil);
            }

            $file = $req->file('gambar_mobil');
            $filePath = 'mobil/' . $file->getClientOriginalName();
            $file->move(public_path('storage/mobil'), $file->getClientOriginalName());

            $data['gambar_mobil'] = $filePath;
        }

        // Cek jika ada banner yang diupload
        if ($req->hasFile('banner_mobil')) {
            if ($mobil->banner_mobil) {
                Storage::delete('public/' . $mobil->banner_mobil);
            }

            $bannerFile = $req->file('banner_mobil');
            $bannerPath = 'mobil/banner/' . $bannerFile->getClientOriginalName();
            $bannerFile->move(public_path('storage/mobil/banner'), $bannerFile->getClientOriginalName());

            $data['banner_mobil'] = $bannerPath;
        }

        // Memperbarui data mobil
        $mobil->update($data);

        // Menghapus fitur yang ditandai
        if ($req->hapus_fitur) {
            foreach ($req->hapus_fitur as $fiturId) {
                // Temukan fitur yang ingin dihapus
                $fitur = $mobil->fiturMobil()->find($fiturId);
                if ($fitur) {
                    // Hapus gambar fitur dari storage jika ada
                    if ($fitur->gambar_fitur_mobil) {
                        Storage::delete('public/' . $fitur->gambar_fitur_mobil);
                    }
                    $fitur->delete(); // Hapus fitur dari database
                }
            }
        }

        // Menyimpan/update fitur mobil yang tidak dihapus
        if ($req->fitur) {
            foreach ($req->fitur as $index => $fitur) {
                if ($fitur) {
                    $gambarFiturPath = null;
                    if (isset($req->gambar_fitur[$index]) && $req->gambar_fitur[$index]->isValid()) {
                        $file = $req->file('gambar_fitur')[$index];
                        $gambarFiturPath = 'mobil/fitur/' . $file->getClientOriginalName();
                        $file->move(public_path('storage/mobil/fitur'), $file->getClientOriginalName());
                    }

                    // Periksa apakah fitur sudah ada dalam database
                    if (isset($mobil->fiturMobil[$index])) {
                        // Jika fitur sudah ada, update
                        $mobil->fiturMobil[$index]->update([
                            'fitur_mobil' => $fitur,
                            'gambar_fitur_mobil' => $gambarFiturPath ?? $mobil->fiturMobil[$index]->gambar_fitur_mobil // Jika gambar tidak baru, tetap gunakan yang lama
                        ]);
                    } else {
                        // Jika tidak ada, tambahkan fitur baru
                        $mobil->fiturMobil()->create([
                            'fitur_mobil' => $fitur,
                            'gambar_fitur_mobil' => $gambarFiturPath
                        ]);
                    }
                }
            }
        }

        // Mengupdate warna mobil
        if ($req->warna) {
            foreach ($req->warna as $index => $warna) {
                if ($warna) {
                    $gambarWarnaPath = null;
                    if (isset($req->gambar_warna[$index]) && $req->gambar_warna[$index]->isValid()) {
                        $file = $req->file('gambar_warna')[$index];
                        $gambarWarnaPath = 'mobil/warna/' . $file->getClientOriginalName();
                        $file->move(public_path('storage/mobil/warna'), $file->getClientOriginalName());
                    }

                    // Periksa apakah warna sudah ada dalam database
                    if (isset($mobil->warnaMobil[$index])) {
                        // Jika warna sudah ada, update
                        $mobil->warnaMobil[$index]->update([
                            'warna_mobil' => $warna,
                            'gambar_warna_mobil' => $gambarWarnaPath ?? $mobil->warnaMobil[$index]->gambar_warna_mobil // Jika gambar tidak baru, tetap gunakan yang lama
                        ]);
                    } else {
                        // Jika tidak ada, tambahkan warna baru
                        $mobil->warnaMobil()->create([
                            'warna_mobil' => $warna,
                            'gambar_warna_mobil' => $gambarWarnaPath
                        ]);
                    }
                }
            }
        }

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
