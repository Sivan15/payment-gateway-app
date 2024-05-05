<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('pay');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => 10000, // Rs.100
            'currency' => 'inr',
        ]);

        return redirect()->route('transaction')->with('paymentIntent', $paymentIntent);
    }

    public function showTransactionDetails()
    {
        $paymentIntent = session('paymentIntent');
        return view('transaction', compact('paymentIntent'));
    }
}
