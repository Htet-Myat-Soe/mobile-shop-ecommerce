<div>
    <div class="wrap-icon-section minicart" >
        <a href="{{route('cart')}}" class="link-direction">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <div class="left-info">
                <span class="index" style="background-color: #ff2832;">{{Cart::instance('cart')->count()}} items</span>
                <span class="title">CART</span>
            </div>
        </a>
    </div>
</div>
