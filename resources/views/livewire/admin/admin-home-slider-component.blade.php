<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h4 class="card-title">Home Slider</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered mb-0">

                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Subtitle</th>
                                <th>Price</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($home_sliders as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>
                                    <img src="{{asset('assets/images/products')}}/{{$item->image}}" alt="" width="100px" height="100px">
                                </td>
                                <td>{{$item->subtitle}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->url}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.homeslideredit',['slider_id' => $item->id])}}" class="text-decoration-none"><i class="fa fa-edit"> </i></a>
                                    <a href="" wire:click.prevent="delete({{ $item->id}})" class="text-decoration-none"><i class="fa fa-trash"> </i></a>
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
