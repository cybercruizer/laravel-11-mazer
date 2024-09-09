<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan=Pengaturan::firstOrCreate(['id' => 1]);
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);
        $pengaturan=Pengaturan::firstOrCreate(['id' => 1]);
        //handle logo image upload and save to public/img folder
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            //remove old logo from public/img folder 
            if ($pengaturan->logo) {
                $oldLogo = public_path('storage/img/'.$pengaturan->logo);
                if (file_exists($oldLogo)) {
                    @unlink($oldLogo);
                }
            }
            $logo = $request->file('logo');
            $logo->storeAs('public/img', $logo->hashName());
            $pengaturan->update([
                'logo' => $logo->hashName(),
            ]);
        }
        
        $pengaturan->update([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);
        Alert::toast('Pengaturan tersimpan', 'success');
        return back();
    }
}
