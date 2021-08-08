<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h4 class="card-title">Coupons</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered mb-0">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Coupon Value</th>
                                <th>Cart Value</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($coupons as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->type}}</td>
                                @if($item->type == 'fixed')
                                <td>{{$item->value}}</td>
                                @else
                                <td>{{$item->value}} %</td>
                                @endif
                                <td>{{$item->cart_value}}</td>
                                <td>{{$item->expiry_date}}</td>
                                <td>
                                    <a href="{{route('admin.editcoupons',['coupon_id' => $item->id])}}" class="text-decoration-none"><i class="fa fa-edit"> </i></a>
                                    <a href="" wire:click.prevent="delete({{ $item->id}})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="text-decoration-none"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
