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
        <p>Date: {{ $paymentDetails['date'] }}</p>
    </div>
</body>
</html>
