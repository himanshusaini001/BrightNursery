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
                 return redirect()->route('cart')->with('message', 'Cart item deleted successfully');
            } else {
                return response()->json(['error' => 'Failed to add product to cart'], 500);
            }
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function deleteCart($id)
    {
       
        $cartItem  = cart::find($id);
        // Check if the cart item exists
        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();
    
            // Redirect to the cart route with a success message
            return redirect()->route('cart')->with('message', 'Cart item deleted successfully');
        } else {
            // If the cart item does not exist, you might want to handle this case
            return response()->json(['message' => 'Cart item not found'], 404);
        }
       
    }

    public function add_cart_with_total(Request $request){
        $qty = $request->qty;
        $id = $request->id;
        $sub_total_tamp = $request->sub_total;

        $product = cart::find($id);
        $price = $product->price;
        $total_price = $qty * $price;

        $sub_total_tamp1 = $total_price - $price;

        $sub_total_final = $sub_total_tamp1 + $sub_total_tamp;
        
       return response()->json([
        'total_price' => $total_price,
        'id' => $id,
        'sub_total' => $sub_total_final,
       ]);
    }


    public function sub_cart_with_total(Request $request){
        $qty = $request->qty;
        $sub_total_tamp = $request->sub_total;
        if($qty == null){
            $qty = $qty + 1;
        }
        $id = $request->id;
        session()->put('cart_tampid', $id);

        $product = cart::find($id);
        $price = $product->price;
        $total_price = $qty * $price;

        $sub_total_tamp1 = $total_price - $price;

        $sub_total_final = $sub_total_tamp1 + $sub_total_tamp;
       return response()->json([
        'total_price' => $total_price,
        'id' => $id,
        'sub_total' => $sub_total_final, 
       ]);
    }
}
