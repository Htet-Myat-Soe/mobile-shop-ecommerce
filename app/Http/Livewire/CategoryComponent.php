<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class CategoryComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $slug;
    public $min_price;
    public $max_price;

    public function mount($slug){
        $this->slug = $slug;
        $this->min_price = 1;
        $this->max_price = 1000;
    }
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('message','Item add In Cart');
        return redirect()->route('cart');
    }
    use WithPagination;
    public function render()
    {
        $category = Category::where('slug',$this->slug)->first();
        $cat_id = $category->id;
        $cat_name = $category->name;
        if($this->sorting == 'date'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('category_id',$cat_id)->orderBy('created_at','DESC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('category_id',$cat_id)->orderBy('regular_price','ASC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price-desc'){
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('category_id',$cat_id)->orderBy('regular_price','DESC')->paginate($this->pagesize);

        }
        else{
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('category_id',$cat_id)->paginate($this->pagesize);
        }
        $categories = Category::all();
        $sale = Sale::find(1);
        $rproducts = Product::inRandomOrder()->limit(4)->get();

        return view('livewire.category-component',['products' => $products,'categories' => $categories,'cat_name'=>$cat_name,'sale'=>$sale,'rproducts' => $rproducts])->layout('layouts.base');
    }
}
