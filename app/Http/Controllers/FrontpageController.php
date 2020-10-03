<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontpageController extends Controller
{
    public function home()
    {
    	$data = DB::table('items')->get();
    	return view('front_page.front_page', compact('data'));
    }
}
