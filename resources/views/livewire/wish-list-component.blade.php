<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
        <style>
            .product-wish{
                position: absolute;
                top: 10%;
                left: 0%;
                z-index: 99;
                right: 30px;
                text-align: right;
                padding-top: 0;
            }
            .product-wish .fa{
                color: rgb(197, 164, 164);
                font-size: 32px;
                transition: .4s;
            }
            .product-wish .fa:hover{
                color:#ff0000;
            }
            .fill-heart{
                color:#ff0000 !important;
            }
        </style>
        <div class="row">
            @if(Cart::instance('wishlist')->content()->count() > 0)
            <ul class="product-list grid-products equal-container">
                @foreach(Cart::instance('wishlist')->content() as $product)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{url('/details')}}/{{$product->model->slug}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="{{asset('assets/images/products')}}/{{$product->model->image}}" ></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{url('/details')}}/{{$product->model->slug}}" class="product-name"><span>{{$product->model->name}}</span></a>

                            @if ($product->model->sale_price > 0  && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                            <div class="wrap-price"><span class="product-price">$ {{$product->model->sale_price}}</span><del><span class="text-secondary">{{$product->regular_price}}</span></del></div>
                            @else
                            <div class="wrap-price"><span class="product-price"> $ {{$product->model->regular_price}}</span></div>
                            @endif
                            <a href="javascript:void(0)" wire:click.prevent="moveProductFromWishlist('{{$product->rowId}}')" class="btn add-to-cart" style="background-color: #ff2832;">Move to Cart</a>

                        </div>
                        <div class="product-wish">
                            <a href="#" wire:click.prevent="removeFromWishlist('{{$product->model->id}}')"><i class="fa fa-heart fill-heart"></i></a>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            @else
            <h3 class="text-center">No Item In Wish List</h3>
            @endif

        </div>
    </div><!--end main products area-->


</main>
