<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactController extends Controller
{
    public function checkout(){
        return view('frontend.contact');
    }
}
