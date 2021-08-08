<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    <p>Hi {{$order->firstname}} {{$order->lastname}}</p>
    <p>Your Order has been successfully placed.</p>
    <br>
    <table style="width: 600px">
        <thead>
            <th>
                <td>Image</td>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
            </th>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td>
                    <img src="{{asset('assets/images/products')}}/{{$item->product->image}}" width="100px" height="130px" alt="">
                </td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price * $item->quantity}}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3">Subtotal</th>
                <td>$ {{$order->subtotal}}</td>
            </tr>
            <tr>
                <th colspan="3">Shipping</th>
                <td>Free Shipping</td>
            </tr>
            <tr>
                <th colspan="3">Tax</th>
                <td>$ {{$order->tax}}</td>
            </tr>
            <tr>
                <th colspan="3">Total</th>
                <td>$ {{$order->total}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
