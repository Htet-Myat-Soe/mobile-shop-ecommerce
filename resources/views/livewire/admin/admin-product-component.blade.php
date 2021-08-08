<div>

    <style>
        nav svg{
            height: 20px;
        }
    </style>

    <div class="card bg-light">
        <div class="card-header d-flex justify-content-between">
            <h3>Products Table</h3>
            <a href="{{route('admin.productAdd')}}" class="btn btn-dark">Add New</a>
        </div>
        <div class="card-body">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{asset('assets/images/products')}}/{{$product->image}}" alt="No Photo" width="100px" height="100px">
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->stock_status}}</td>
                        <td>{{$product->regular_price}}</td>
                        <td>{{$product->sale_price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>
                            <a href="{{url('/admin/product/edit')}}/{{$product->slug}}"><i class="fa fa-edit"></i></a>
                            <a href="" onclick="confirm('Are you Sure?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{$product->id}})"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
