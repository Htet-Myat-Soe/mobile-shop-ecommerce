
<div>
    <div class="container">
       <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Order Tables</h3>
               </div>
               <div class="card-body">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>OrderId</th>
                               <th>Subtotal</th>
                               <th>Discount</th>
                               <th>Tax</th>
                               <th>Total</th>
                               <th>First Name</th>
                               <th>Mobile</th>
                               <th>Email</th>
                               <th>Zipcode</th>
                               <th>Status</th>
                               <th>Order Date</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>${{$order->subtotal}}</td>
                                <td>${{$order->discount}}</td>
                                <td>${{$order->tax}}</td>
                                <td>${{$order->total}}</td>
                                <td>{{$order->firstname}}</td>
                                <td>{{$order->mobile}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->zipcode}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a href="{{route('user.orderdetails',['order_id' => $order->id])}}" class="btn btn-dark">Details</a>
                                </td>

                            </tr>
                           @endforeach
                       </tbody>
                   </table>
                   {{$orders->links()}}
               </div>
           </div>
       </div>
       </div>
   </div>
</div>
