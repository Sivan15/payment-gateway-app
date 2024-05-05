<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ensure you have this CSS file for Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <h1>Laravel 10 How To Integrate Stripe Payment Gateway</h1>
        <div class="card">
            <div class="card-header">
                Checkout
            </div>
            <div class="card-body">
            <form action="{{ route('session') }}" method="POST">
                @csrf
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Asus Vivobook 17 Laptop - Intel Core 10th</td>
                                <td>₹100</td>
                                <td>
                                    <input type="number" name="quantity" value="1" class="form-control" min="1">
                                </td>
                                <td class="text-center">₹100</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                                <td class="text-center">₹100</td>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="submit" class="btn btn-success">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>
