<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dosen;
use App\User;

class MasterDosenController extends Controller
{
    public function index(Request $request)
    {
    	$dosens = Dosen::all();
    	return view('user.paj.masterdosen.index', ['dosens'=>$dosens]);
    }

    public function simpan(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required|string',
    		'password' => 'required|min:6',
    		'username' => 'required|string',
    		'npk' => 'required|string',
    		'role' => 'required|numeric',
    		'kelayakan' => 'required|boolean',
    	]);

    	$user = new User();
    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->password = bcrypt($request->password);
    	$user->npk = $request->npk;
    	$user->role = $request->role;
    	$user->save();

    	$dosen = new Dosen();
    	$dosen->kelayakan = $request->kelayakan;
    	$dosen->user_id = $user->id;
    	$dosen->save();

    	return back()->with('status', 'Data dosen baru dengan NPK '.$request->npk.' telah disimpan.');
    }

    public function get($id)
    {
    	return Dosen::with('user')->whereId($id)->firstOrFail();
    }

    public function update(Request $request, $id)
    {
    	if($request->password){
    		$this->validate($request,[
	    		'name' => 'required|string',
	    		'password' => 'required|min:6',
	    		'npk' => 'required|string',
	    		'role' => 'required|numeric',
	    		'kelayakan' => 'required|boolean',
	    	]);
    	}
    	else{
    		$this->validate($request,[
	    		'name' => 'required|string',
	    		'npk' => 'required|string',
	    		'role' => 'required|numeric',
	    		'kelayakan' => 'required|boolean',
	    	]);
    	}
    	
    	$dosen = Dosen::findOrFail($id);
    	$namaLama = $dosen->user->name;
    	$dosen->kelayakan = $request->kelayakan;
    	$dosen->save();
    	$dosen->user->name = $request->name;
    	if($request->password){
    		$dosen->user->password = bcrypt($request->password);
    	}
    	$dosen->user->npk = $request->npk;
    	$dosen->user->role = $request->role;
    	$dosen->user->save();

    	return back()->with('status', 'Data dosen '.$namaLama.' telah diperbarui.');
    }

    public function hapus($id)
    {
    	$dosen = Dosen::findOrFail($id);
    	$dosen->delete();
    	$dosen->user->delete();
    	return back()->with('status', 'Data dosen '.$dosen->user->name.' ('.$dosen->user->npk.") telah dihapus.");
    }
}
