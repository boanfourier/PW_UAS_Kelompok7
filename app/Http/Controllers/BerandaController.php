<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function home(){
		return view('beranda');
	}
 
	public function about(){
		return view('about');
	}
 

}
