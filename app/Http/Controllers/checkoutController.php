<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function checkout(){
        return view('frontend.checkout');
    }
}
