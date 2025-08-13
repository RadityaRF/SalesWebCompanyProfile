<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $files = Promo::all()->map(function ($promo) {
            return [
                'name' => $promo->title,
                'url'  => asset('storage/' . $promo->image_path), // public/storage path
            ];
        });

        return view('admin.promo.index_promo', compact('files'));
    }
    public function store(Request $request)
    {
        // 1. Validate request
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'image_path'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'created_at'  => 'required|date',
            'updated_at'    => 'required|date|after_or_equal:start_date',
        ]);

        // 2. Store image in public/storage/promos
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('promos', 'public');
        } else {
            $imagePath = null;
        }

        // 3. Save data to MySQL
        $promo = new Promo();
        $promo->title       = $validated['title'];
        // $promo->description = $validated['description'] ?? null;
        $promo->image_path  = $imagePath; // relative path in storage
        $promo->created_at  = $validated['start_date'];
        $promo->updated_at    = $validated['end_date'];
        $promo->save();

        // 4. Redirect or return response
        return redirect()->back()->with('success', 'Promo created successfully!');
    }
    // public function index()
    // {
    //     $files = Storage::files('public/banners');
    //     $files = array_map(function ($file) {
    //         return [
    //             'name' => basename($file),
    //             'url'  => Storage::url($file),
    //         ];
    //     }, $files);

    //     return view('admin.promo.index_promo', compact('files'));
    // }


    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'image_path' => 'nullable|string'
    //     ]);

    //     // Cek apakah ada gambar yang diupload
    //     if ($request->hasFile('image_path')) {
    //         $file = $request->file('image_path');
    //         $filePath = 'promo/' . $file->getClientOriginalName();
    //         $file->move(public_path('storage/promo'), $file->getClientOriginalName());
    //         $data['image_path'] = $filePath;
    //     }

        
    //     // $request->validate([
    //     //     'banner' => 'required|image|max:2048'
    //     // ]);

    //     // $request->file('banner')->store('public/banners');
    //     // return redirect()->route('admin.promo.index')->with('success', 'Banner uploaded!');
    // }

    // public function destroy($filename)
    // {
    //     $path = 'public/banners/' . $filename;
    //     if (Storage::exists($path)) {
    //         Storage::delete($path);
    //         return redirect()->route('admin.promo.index')->with('success', 'Banner deleted!');
    //     }
    //     return redirect()->route('admin.promo.index')->with('error', 'File not found!');
    // }
}
