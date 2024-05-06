<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function showPayButton()
    {
        return view('pay');
    }

    public function checkout() {
        return view('checkout');
    }

    public function payMethod(Request $request) {
        return redirect()->route('checkout');
    }

    public function session(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret')); // Ensure you're pulling from .env correctly
        
        $user = Auth::user(); // Assuming user authentication is correctly handled
        
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => 'Generic Product',
                    ],
                    'unit_amount' => 10000, // Rs.100 expressed in paise
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'), // Use the correct route name
            'cancel_url' => route('payment.cancel'), // Use the correct route name
        ]);
        
        return redirect()->away($session->url);
    }

    // Add this to your StripeController

public function success(Request $request)
{
    Stripe::setApiKey(config('stripe.secret'));

    // Assuming you are sending the session ID as a query parameter from the Stripe success_url
    $sessionId = $request->session_id;

    $session = StripeSession::retrieve($sessionId);

    // Retrieve payment intent details
    $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

    // You can now pass these details to your view
    return view('success', ['paymentDetails' => $paymentIntent]);
}


    public function cancel() {
        return view('cancel');
    }
}
