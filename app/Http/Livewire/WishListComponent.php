<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Cart;
class WishListComponent extends Component
{
    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wish-count-component','refreshComponent');
            }
        }

    }

    public function moveProductFromWishlist($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
        $this->emitTo('cart-count-component','refreshComponent');

    }

    public function render()
    {
        $sale = Sale::find(1);

        return view('livewire.wish-list-component',['sale'=>$sale])->layout('layouts.base');
    }
}
