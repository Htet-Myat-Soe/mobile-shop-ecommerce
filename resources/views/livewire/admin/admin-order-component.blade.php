
<div>
     <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Order Tables</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('order_message'))
                        <div class="alert alert-success">{{Session::get('order_message')}}</div>
                    @endif
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
                                <th>Zipcode</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                                <th>status</th>
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
                                 <td>{{$order->zipcode}}</td>
                                 <td>{{$order->status}}</td>
                                 <td>{{$order->created_at}}</td>
                                 <td>
                                     <a href="{{route('admin.orderdetails',['order_id' => $order->id])}}" class="btn btn-dark">Details</a>
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Status
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'delivered')">Delivered</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'canceled')">Canceled</a></li>
                                        </ul>
                                    </div>
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
