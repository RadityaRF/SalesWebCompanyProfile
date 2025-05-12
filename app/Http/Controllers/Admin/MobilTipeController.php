<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\MobilTipe;
use Illuminate\Http\Request;

class MobilTipeController extends Controller
{
    // Karena shallow(), show/edit/update/delete hanya butuh {tipe}
    public function create(Mobil $mobil)
    {
        return view('admin.mobil.tipe.create', compact('mobil'));
    }

    public function store(Request $req, Mobil $mobil)
    {
        $data = $req->validate([
            'nama_tipe'          => 'required|string',
            'spesifikasi'        => 'nullable|string',
            'gambar_mobil_tipe'  => 'nullable|image',
            'harga_mobil'        => 'required|numeric'
        ]);
        if($req->hasFile('gambar_mobil_tipe')){
            $data['gambar_mobil_tipe'] = $req->file('gambar_mobil_tipe')
                                               ->store('mobil_tipe','public');
        }
        $mobil->tipeMobil()->create($data);
        return redirect()->route('admin.mobil.show', $mobil->id)
                         ->with('success','Tipe mobil ditambahkan');
    }

    public function edit(MobilTipe $tipe)
    {
        return view('admin.mobil.tipe.edit', compact('tipe'));
    }

    public function update(Request $req, MobilTipe $tipe)
    {
        $data = $req->validate([
            'nama_tipe' => 'required|string',
            'spesifikasi' => 'nullable|string',
            'gambar_mobil_tipe' => 'nullable|image',
            'harga_mobil'=> 'required|numeric'
        ]);
        if($req->hasFile('gambar_mobil_tipe')){
            $data['gambar_mobil_tipe'] = $req->file('gambar_mobil_tipe')
                                            ->store('mobil_tipe','public');
        }
        $tipe->update($data);
        return back()->with('success','Tipe mobil diupdate');
    }

    public function destroy(MobilTipe $tipe)
    {
        $tipe->delete();
        return back()->with('success','Tipe mobil dihapus');
    }
}
