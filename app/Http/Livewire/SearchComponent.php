<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class SearchComponent extends Component
{
    use WithPagination;
    public $search;
    public $product_cat;
    public $product_cat_id;
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;

    public function mount(){
        $this->min_price = 1;
        $this->max_price = 1000;
        $this->sorting = 'default';
        $this->pagesize = 12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }
    public function store($product_id,$product_name,$product_price){

        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success','Item add to cart successfully');
        return redirect()->route('cart');
    }

    public function render()
    {
        $categories = Category::all();
        $sale = Sale::find(1);
        if($this->sorting == 'date'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        elseif ($this->sorting == 'price') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        elseif ($this->sorting == 'price-desc') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        }
        $rproducts = Product::inRandomOrder()->limit(4)->get();

        return view('livewire.search-component',['products' => $products,'categories' => $categories,'product_cat',$this->product_cat,'sale'=>$sale,'rproducts' => $rproducts])->layout('layouts.base');
    }
}
