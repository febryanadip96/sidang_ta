<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tempat;

class MasterTempatController extends Controller
{
    public function index(Request $request)
    {
    	$tempats = Tempat::all();
    	return view('user.paj.mastertempat.index', ['tempats' => $tempats]);
    } 

    public function simpan(Request $request)
    {
    	$this->validate($request,[
    		'nama' => 'required',
    	]);

    	$tempat = new Tempat();
    	$tempat->nama = $request->nama;
    	$tempat->save();

    	return back()->with('status', 'Tempat baru dengan nama '.$request->nama.' telah disimpan.');
    }

    public function get($id)
    {
    	return Tempat::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request,[
    		'nama' => 'required',
    	]);

    	$tempat = Tempat::findOrFail($id);
    	$namaLama = $tempat->nama;
    	$tempat->nama = $request->nama;
    	$tempat->save();

    	return back()->with('status', 'Tempat dengan nama '.$namaLama.' telah diperbarui.');
    }

    public function hapus(Request $request, $id)
    {
    	$tempat = Tempat::findOrFail($id);
    	$tempat->delete();

    	return back()->with('status', 'Tempat dengan nama '.$tempat->nama.' telah dihapus.');
    }
}
