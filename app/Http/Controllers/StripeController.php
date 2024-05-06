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
        return view('dashboard');
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
        
        // $user = Auth::user(); // Assuming user authentication is correctly handled
        
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
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'), // Use the correct route name
        ]);
        
        return redirect()->away($session->url);
    }

    // Add this to your StripeController

    public function success(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret'));
        $sessionId = $request->query('session_id');
    
        if (!$sessionId) {
            return redirect()->route('error.page'); // Handle this case appropriately
        }
    
        try {
            $session = StripeSession::retrieve($sessionId);
            $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
    
            // Fetch billing details from the payment method
            $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentIntent->payment_method);
    
            $paymentDetails = [
                'amount' => number_format($paymentIntent->amount_received / 100, 2), // Convert to major currency unit
                'currency' => strtoupper($paymentIntent->currency),
                'status' => $paymentIntent->status,
                'type' => $paymentMethod->card->brand ?? 'N/A',
                'date' => date('Y-m-d H:i:s', $paymentIntent->created),
                'name' => $paymentMethod->billing_details->name ?? 'N/A',
                'email' => $paymentMethod->billing_details->email ?? 'N/A',
                'address_line1' => $paymentMethod->billing_details->address->line1 ?? 'N/A',
                'address_city' => $paymentMethod->billing_details->address->city ?? 'N/A',
                'address_country' => $paymentMethod->billing_details->address->country ?? 'N/A',
                'origin' => $paymentMethod->card->country ?? 'N/A',
            'cvc_check' => $paymentMethod->card->checks->cvc_check ?? 'N/A',
            'street_check' => $paymentMethod->card->checks->address_line1_check ?? 'N/A',
            'zip_check' => $paymentMethod->card->checks->address_postal_code_check ?? 'N/A'
            ];
    
            return view('success', ['paymentDetails' => $paymentDetails]);
        } catch (\Exception $e) {
            return redirect()->route('error.page'); // Handle errors appropriately
        }
    }
    

    public function cancel() {
        return view('cancel');
    }
}
