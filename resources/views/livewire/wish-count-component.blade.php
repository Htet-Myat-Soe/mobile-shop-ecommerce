<div>
        <div class="wrap-icon-section wishlist" >
            <a href="{{route('wishlist')}}" class="link-direction">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <div class="left-info">
                    <span class="index" style="background-color: #ff2832;">{{Cart::instance('wishlist')->count()}} item</span>
                    <span class="title">Wishlist</span>
                </div>
            </a>
</div>
