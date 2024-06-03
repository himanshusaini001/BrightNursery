<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class singleprotfolioController extends Controller
{
    public function singleportfolio(){
        return view('frontend.single-portfolio');
    }
}
