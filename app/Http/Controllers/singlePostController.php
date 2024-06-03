<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class singlePostController extends Controller
{
    public function singlePost(){
        return view('frontend.single-post');
    }
}
