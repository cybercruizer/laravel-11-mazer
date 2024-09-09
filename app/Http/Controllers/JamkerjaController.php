<?php

namespace App\Http\Controllers;

use App\Models\Jamkerja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class JamkerjaController extends Controller
{
    public function index()
    {
        $jamkerjas=Jamkerja::get();
        $title = 'Jam Kerja';
        $subtitle = 'Daftar Jam Kerja Normal';
        return view('jamkerja.index', compact('jamkerjas','title', 'subtitle'));
    }
    public function edit($id) {
        $jamkerja = Jamkerja::find($id);
        return response()->json($jamkerja);
    }
    public function show($id) {
        $jamkerja = Jamkerja::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail data jam kerja',
            'data'    => $jamkerja  
        ]);
    }
    public function update(Request $request) {
        //dd($request);
        $validator= Validator::make($request->all(), [
            'jamid'     => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'is_libur' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jamkerja = Jamkerja::find($request->jamid);

        $jamkerja->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'is_libur' => $request->is_libur
        ]);
        if ($jamkerja) {
            Alert::toast('Jam kerja hari '. $jamkerja->hari.' berhasil diubah', 'success');
        }
        return back();
    }
}
