<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dosen;

class MasterDosenController extends Controller
{
    public function index(Request $request)
    {
    	$dosens = Dosen::all();
    	return view('user.paj.masterdosen.index', ['dosens'=>$dosens]);
    }
}
