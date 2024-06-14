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

        $products = product::whereIn('cid', $categoryId)->get();
        
        $totalProduct = $products->count();

            return view('frontend.shop',['category'=>$category,'product'=>$products,'totalProduct'=>$totalProduct]);
        }

        public function getproduct($value = null) {
            if (is_numeric($value)) {
                $products = product::where('cid', $value)->get();
                return response()->json([
                    'data' => $products,
                ]);
            } elseif ($value == "AtoZ") {
                $products = product::orderBy('name', 'asc')->get();  // Assuming you want to sort the products alphabetically
                return response()->json([
                    'data' => $products,
                ]);
            } 
            elseif ($value == "ZtoA") {
                $products = product::orderBy('name', 'desc')->get();  // Assuming you want to sort the products alphabetically
                return response()->json([
                    'data' => $products,
                ]);
            } else {
                $AllProduct = product::all();
                return response()->json([
                    'data' => $AllProduct,
                ]);
            }
        }

        
}
