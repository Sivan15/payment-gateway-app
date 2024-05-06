<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <div>
        <p>Amount: {{ $paymentDetails['amount'] }} {{ $paymentDetails['currency'] }}</p>
        <p>Status: {{ $paymentDetails['status'] }}</p>
        <p>Type: {{ $paymentDetails['type'] }}</p>
        <p>Date: {{ $paymentDetails['date'] }}</p>
        <p>Name: {{ $paymentDetails['name'] }}</p>
        <p>Email: {{ $paymentDetails['email'] }}</p>
        <p>Address: {{ $paymentDetails['address_line1'] }}, {{ $paymentDetails['address_city'] }}, {{ $paymentDetails['address_country'] }}</p>
        <p>Origin: {{ $paymentDetails['origin'] }}</p>
        <p>CVC Check: {{ $paymentDetails['cvc_check'] }}</p>
        <p>Street Check: {{ $paymentDetails['street_check'] }}</p>
        <p>Zip Check: {{ $paymentDetails['zip_check'] }}</p>
    </div>

    <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
</body>
</html>
