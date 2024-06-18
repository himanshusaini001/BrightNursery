<?php

namespace App\Http\Controllers;


use App\Models\product;
use App\Models\categories;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Configuration\Php;

class shopController extends Controller
{
    protected $categories;
    protected $AllProducts;
    protected $AllProductCount;
    protected $category_with_product;
    
    public function __construct()
    {
        $this->categories = categories::where('status', 1)->get();
        $this->AllProducts = product::where('status', 1)->get();
        $this->AllProductCount = $this->AllProducts->count();

        $this->category_with_product = [];
        foreach ($this->categories as $category) {
            $products = product::where('cid', $category->id)->get();
            $this->category_with_product[] = [
                // 'category' => $category,
                 'products' => $products,
                'product_count' => $products->count()
            ];
        }
    }

    public $pages = 5;
    public function shop($id = null){

        $category = categories::all();
        
        $categoryId = $category->pluck('id'); 

        

        $Allproducts = product::all();
        $totalProduct = $Allproducts->count();

        
        $products = product::whereIn('cid', $categoryId)->paginate($this->pages);
        
       

            return view('frontend.shop',['category'=>$category,'product'=>$products,'totalProduct'=>$this->AllProductCount,'category_with_product' => $this->category_with_product,]);
           
        }

    public function getproduct($value = null) {
        if (is_numeric($value)) {
            $products = product::where('cid', $value)->paginate($this->pages);
            return response()->json([
                'data' => $products,
                'paginationLinks' => $products->links()->toHtml(),
            ]);
        } elseif ($value == "AtoZ") {
            $products = product::orderBy('name', 'asc')->paginate($this->pages);  // Assuming you want to sort the products alphabetically
            return response()->json([
                'data' => $products,
                'paginationLinks' => $products->links()->toHtml(),
            ]);
        } 
        elseif ($value == "ZtoA") {
            $products = product::orderBy('name', 'desc')->paginate($this->pages);  // Assuming you want to sort the products alphabetically
            return response()->json([
                'data' => $products,
                'paginationLinks' => $products->links()->toHtml(),
            ]);
        } 
        elseif ($value == "LowtoHigh") {
            $products = product::orderBy('price', 'asc')->paginate($this->pages);  // Assuming you want to sort the products alphabetically
            return response()->json([
                'data' => $products,
                'paginationLinks' => $products->links()->toHtml(),
            ]);
        }
        elseif ($value == "HighttoLow") {
            $products = product::orderBy('price', 'desc')->paginate($this->pages);  // Assuming you want to sort the products alphabetically
            return response()->json([
                'data' => $products,
                'paginationLinks' => $products->links()->toHtml()
            ]);
        }else {
            $AllProduct = product::all();
            return response()->json([
                'data' => $AllProduct,
            ]);
        }
    }

}
