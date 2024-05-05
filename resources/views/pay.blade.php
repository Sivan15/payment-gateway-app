<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Transaction</title>
</head>
<body>
<h1>Welcome, {{ Auth::user()->name }}</h1>
<p>Click the button below to make a payment of Rs. 100.</p>

<!-- This should be in your pay.blade.php or a similar file where you have the Pay Now button -->
<form action="{{ route('session') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Pay Now</button>
</form>


</body>
</html>
