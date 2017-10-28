<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterDosenController extends Controller
{
    public function index(Request $request)
    {
    	return view('user.paj.masterdosen.index');
    }
}
