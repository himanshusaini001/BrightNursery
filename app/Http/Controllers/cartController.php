<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check()) {
            // If user is authenticated, get user ID
            $user_id = Auth::id();
            $cart_data = cart::where('user_id',$user_id)->get();
           
          
        } else {
            // If user is not authenticated, get session ID
            $session_id  = Session::getId();
            $cart_data = cart::where('session_id',$session_id)->get();
        } 
       
        $cart = session()->get('cart', []);
        return view('frontend.cart', [
            'cart' => $cart,
            'cart_data' => $cart_data,  // Corrected the array syntax here
        ]);
    }

    public function addToCart(Request $request)
    {
        
        // Validate request data
        $request->validate([
            'qty' => 'required',
            'id' => 'required'
        ]);

        $qty = $request->qty;
        $id = $request->id;
        $tampid='0';
        $sessionid = session()->get('tampid');
        if($sessionid ){
            $tampid = $sessionid;
        }
        else{
            $tampid='0';
        }
       

        // Fetch the product by ID
        $product = Product::find($id);

        if ($product) {
            
           
            if (Auth::check()) {
                $session_id = null;
                $user_id = Auth::id();
            } else {
                $user_id = null;
                $session_id  = Session::getId();
            }

            $addcart = Cart::create([
                'tampid' => $tampid,
                'user_id' => $user_id,
                'product_id' => $product->id,
                'session_id' => $session_id,
                'product_name' => $product->name,
                'product_quantity' => $qty,
                'price' => $product->price,
                'stock' => $product->stock,
            ]);
            if ($addcart) {
                return response()->json(['message' => 'Product added to cart'], 200);
            } else {
                return response()->json(['error' => 'Failed to add product to cart'], 500);
            }
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    // public function removeFromCart(Request $request)
    // {
    //     $id = $request->id;
        
    //     // Retrieve cart from session
    //     $cart = session()->get('cart', []);
        
    //     // Check if the product exists in the cart
    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
            
    //         // Save the updated cart back to the session
    //         session()->put('cart', $cart);
            
    //         // Return a success response
    //         return response()->json(['success' => 'Product removed from cart'], 200);
    //     }
        
    //     // Return an error response if product not found in cart
    //     return response()->json(['error' => 'Product not found in cart'], 404);
    // }
}
