<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoriesController extends Controller
{
    public function addcategories(){
        return view('admin.categories.addcategories');
    }
}