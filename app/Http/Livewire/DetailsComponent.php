<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Cart;
class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public function mount($slug){
        $this->slug = $slug;
        $this->qty = 1;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        session()->flash('message','Item add In Cart');
        return redirect()->route('cart');
    }
    public function increaseQty(){
        $this->qty++;
    }
    public function decreaseQty(){
        if($this->qty > 0){
            $this->qty--;
        }
    }
    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $p_products = Product::where('regular_price','>',150)->inRandomOrder()->limit(4)->get();
        $r_products = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        return view('livewire.details-component',['product'=>$product,'p_products'=>$p_products,'r_products'=>$r_products])->layout('layouts.base');
    }
}
