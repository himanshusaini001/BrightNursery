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

    
        public function getproduct($id=null){
           
           if($id){
            $products = product::where('cid', $id)->get();
            
            return response()->json([
                'data' => $products,
            ]);
          
            }else{
                $AllProduct = product::all();

                return response()->json([
                    'data' => $AllProduct,
                ]);
            }
            
            }
        
}
