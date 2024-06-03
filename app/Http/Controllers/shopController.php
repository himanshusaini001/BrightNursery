<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopController extends Controller
{
    public function shop(){
        return view('frontend.shop');
    }
}
