<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Stripe;
//use Stripe\Stripe as StripeStripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        // for test
        // print_r($request->all());

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 100*100,
            'currency'=>"usd",
            'source'=> $request->stripeToken,
            'description' =>'Test payment from Maged'
        ]);

        Session::flash('success','Payment has been successfully');
        return back();
    }

    // public function PostPayment(Request $req)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     $customer = $stripe->customers->create([
    //         'description' => 'example customer',
    //         'email' => 'email@example.com',
    //         'payment_method' => 'pm_card_visa',
    //     ]);
    //     echo $customer;
    // }
}
