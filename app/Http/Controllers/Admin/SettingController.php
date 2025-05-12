<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting; // asumsikan ada model Setting(key,value)

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value','key')->all();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $req)
    {
        $data = $req->only(['banner_image','contact_email','contact_phone']);
        // upload banner jika ada
        if($req->hasFile('banner_image')){
            $path = $req->file('banner_image')->store('settings','public');
            Setting::updateOrCreate(['key'=>'banner_image'],['value'=>$path]);
        }
        Setting::updateOrCreate(['key'=>'contact_email'],['value'=>$req->contact_email]);
        Setting::updateOrCreate(['key'=>'contact_phone'],['value'=>$req->contact_phone]);

        return back()->with('success','Settings disimpan');
    }
}
