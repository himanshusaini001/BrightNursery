<?php

namespace App\Http\Controllers;


use App\Models\product;
use App\Models\categories;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Configuration\Php;

class shopController extends Controller
{
    public function shop($id = null){
 $category = categories::all();
        
        $categoryId = $category->pluck('id'); 

        $products = Product::whereIn('cid', $categoryId)->get();
        
        $totalProduct = $products->count();
            return view('frontend.shop',['category'=>$category,'product'=>$products,'totalProduct'=>$totalProduct]);
    }

    
}
