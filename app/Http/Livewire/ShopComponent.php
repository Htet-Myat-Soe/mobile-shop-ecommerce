<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    public function mount(){
        $this->sorting = 'default';
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('message','Item add In Cart');
        return redirect()->route('cart');
    }
    public function addWishList($product_id,$product_name,$product_price){
       Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
       $this->emitTo('wish-count-component','refreshComponent');
    }

    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wish-count-component','refreshComponent');
            }
        }

    }

    use WithPagination;
    public function render()
    {
        if($this->sorting == 'date'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price-desc'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);

        }
        else{
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }
        $categories = Category::all();
        $sale = Sale::find(1);
        $rproducts = Product::inRandomOrder()->limit(4)->get();

        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
        return view('livewire.shop-component',['products' => $products,'categories' => $categories,'sale'=>$sale,'rproducts' => $rproducts])->layout('layouts.base');
    }
}
