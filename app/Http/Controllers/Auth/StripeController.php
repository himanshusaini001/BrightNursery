<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout.stripe');
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment from ' . $request->email,
            ]);

            // You can save payment information into your database here

            return back()->with('success_message', 'Payment successful!');
        } catch (\Exception $ex) {
            return back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}
