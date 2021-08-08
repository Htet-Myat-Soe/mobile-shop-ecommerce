<div>
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
                @if (Session::has('message'))
                <div class="alert alert-success">
                    <p>{{Session::get('message')}}</p>
                </div>
            @endif
            @if (Cart::instance('cart')->count() > 0)
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                @if(Cart::instance('cart')->count() > 0)
                <ul class="products-cart">
                    @foreach (Cart::instance('cart')->content() as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt=""></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{route('details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                        </div>
                        @if ($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                        <div class="price-field produtc-price"><p class="price">$ {{$item->model->sale_price}}</p></div>
                        @else
                        <div class="price-field produtc-price"><p class="price">$ {{$item->model->regular_price}}</p></div>
                        @endif
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >
                                <a class="btn btn-increase" href="" wire:click.prevent="increaseQty('{{$item->rowId}}')"></a>
                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQty('{{$item->rowId}}')"></a>
                            </div>
                            <p class="text-center"><a href="" wire:click.prevent="saveForLater('{{$item->rowId}}')">save for later</a></p>
                        </div>
                        <div class="price-field sub-total"><p class="price">{{$item->subtotal}}</p></div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="" wire:click.prevent="delete('{{$item->rowId}}')">
                                <span>Delete from your cart</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                    <h3 class="text-center">No Item Here</h3>
                @endif
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{Cart::subtotal()}}</b></p>
                    @if (Session::has('coupon'))
                    <p class="summary-info"><span class="title">Discount ({{Session::get('coupon')['code']}}) <a href="" wire:click.prevent="removeCoupon" class="fa fa-times"></a></span><b class="index">- $ {{$discount}}</b></p>
                    <p class="summary-info"><span class="title">Subtotal with discount</span><b class="index">{{$subtotalAfterDiscount}}</b></p>
                    <p class="summary-info"><span class="title">Tax ({{config('cart.tax')}}%)</span><b class="index">$ {{$taxAfterDiscount}}</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">$ {{$totalAfterDiscount}}</b></p>
                    <div class="checkout-info">
                        <a class="btn btn-checkout" style="background-color: #ff2832;" href="" wire:click.prevent="checkout">Checkout</a>
                        <a class="link-to-shop" href="/shop">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>

                    @else
                    <p class="summary-info"><span class="title">Shipping</span><b class="index">Free</b></p>
                    <p class="summary-info"><span class="title">Tax</span><b class="index">{{Cart::tax()}}</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{Cart::total()}}</b></p>
                    @endif
                </div>
                @if (!Session::has('coupon'))
                <div class="checkout-info">
                    <label class="checkbox-field">
                        <input class="frm-input " name="have-code" value="1" wire:model="haveCouponCode" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                    </label>
                    @if ($haveCouponCode == 1)
                    <div class="summary-item">
                        <form wire:submit.prevent="applyCouponCode">
                            <h4 class="title-box">Coupon Code</h4>
                            @if (Session::has('coupon_message'))
                                <div class="alert alert-danger">{{Session::get('coupon_message')}}</div>
                            @endif
                            <p class="row-in-form">
                                <input type="text" placeholder="Coupon Code" name="coupon-code" wire:model="coupon_code">
                            </p>
                            <button type="submit" class="btn btn-small" style="background-color: #ff2832;">Apply</button>
                        </form>
                    </div>
                    @endif
                    <a class="btn btn-checkout" style="background-color: #ff2832;" href="" wire:click.prevent="checkout">Checkout</a>
                    <a class="link-to-shop" href="/shop">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
				@endif



                <div class="update-clear">
                    <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>
            @else
                    <h3 class="text-center">Your cart is empty <br><a href="{{route('shop')}}" class="btn btn-primary my-5"> Go To Shop</a></h3>

            @endif

            <hr>
                <div class="wrap-iten-in-cart">
					<h3 class="box-title">{{Cart::instance('saveForLater')->count()}} item(s) saved for later</h3>
                    @if(Cart::instance('saveForLater')->count() > 0)
                    <ul class="products-cart">
                        @foreach (Cart::instance('saveForLater')->content() as $item)
                        <li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt=""></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="{{route('details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
							</div>
                            @if ($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
							<div class="price-field produtc-price"><p class="price">$ {{$item->model->sale_price}}</p></div>
                            @else
							<div class="price-field produtc-price"><p class="price">$ {{$item->model->regular_price}}</p></div>
                            @endif
                            <div class="price-field produtc-price"><p class="price"><a href=""  wire:click.prevent="moveToCart('{{$item->rowId}}')">Move to Cart</a></p></div>
							<div class="delete">
								<a href="#" class="btn btn-delete" title="" wire:click.prevent="deleteSaveForLater('{{$item->rowId}}')">
									<span>Delete from your cart</span>
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</a>
							</div>
						</li>
                        @endforeach
					</ul>
                    @else
                        <h3 class="text-center">No Item Here</h3>
                    @endif
				</div>
			</div><!--end main content area-->
		</div><!--end container-->

	</main>
</div>
