<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Success</h1>
    <div>
        <h2>Transaction Details:</h2>
        <p>Amount: ${{ number_format($paymentDetails->amount / 100, 2) }}</p>
        <p>Status: {{ $paymentDetails->status }}</p>
        <!-- Add more details as needed -->
    </div>
</body>
</html>
