<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopDetailsController extends Controller
{
    public function shopDetail(){
        return view('frontend.shop-detail');
    }
}
