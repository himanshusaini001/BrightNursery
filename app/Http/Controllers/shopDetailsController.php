<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class shopDetailsController extends Controller
{
    public function shopDetail($id){

        $product = product::where('id',$id)->get();
        
        return view('frontend.shop-details',['data' =>$product]);
    }

    public function addQuantity(){
        echo "ok";
    }
}   
