<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;

class cartController extends Controller
{
    public function cart(){
        
        $cart = session()->get('cart', []);
        return view('frontend.cart', ['cart ' => $cart]);
    }

    public function addToCart(Request $request)
    {
        // Validate request data
        // $request->validate([
        //     'qty' => 'required|integer|min=1',
        //     'id' => 'required|integer|exists:products,id'
        // ]);

        $qty = $request->qty;
        $id = $request->id;

        // Fetch the product by ID
        $product = product::find($id);
        print_r($product);exit;
        if($product){
            $addcart = cart::create([
                'cid' => $product->cid,
                'name' => $product->name,
                ''
            ]);
        }
    }
    
    
    public function removeFromCart(Request $request)
    {
        $id = $request->id;
        
        // Retrieve cart from session
        $cart = session()->get('cart', []);
        
        // Check if the product exists in the cart
        if (isset($cart[$id])) {
            unset($cart[$id]);
            
            // Save the updated cart back to the session
            session()->put('cart', $cart);
            
            // Return a success response
            return response()->json(['success' => 'Product removed from cart'], 200);
        }
        
        // Return an error response if product not found in cart
        return response()->json(['error' => 'Product not found in cart'], 404);
    }
}
