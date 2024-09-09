<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Alert;

class DeviceController extends Controller
{
    function index () {
        $devices = Device::get();
        $title ='Devices';
        $subtitle = 'Daftar Device Presensi';
        $titlealert = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($titlealert, $text);
        return view('device.index', compact('devices','title','subtitle'));
    }
    function store (Request $request) {
        $request->validate([
            'device_name' => 'required',
            'device_location' => 'required',
        ]);
        $randomID= random_int(100000, 999999);
        $device_id = 'D-'.$randomID;
        Device::create([
            'device_id' => $device_id,
            'device_name' => $request->device_name,
            'device_location' => $request->device_location,
            'is_active' => 1,
        ]);
        toast('Device berhasil ditambahkan','success');
        return redirect()->route('device.index');
    }

    function edit ($id) {
        $device = Device::find($id);
        return view('device.edit', compact('device'));
    }

    function destroy($id) {
        $device = Device::find($id);
        $device->delete();
        toast('Device berhasil dihapus','error');
        return redirect()->route('device.index');
    }
}
