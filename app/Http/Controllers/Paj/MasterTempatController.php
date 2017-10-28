<?php

namespace App\Http\Controllers\Paj;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterTempatController extends Controller
{
    public function index(Request $request)
    {
    	return view('user.paj.mastertempat.index');
    }
}
