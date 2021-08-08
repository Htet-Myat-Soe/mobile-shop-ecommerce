<?php

namespace App\Http\Livewire;

use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {

        $slider = HomeSlider::all();
        $lproducts = Product::orderBy('created_at','DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',',$category->sel_categories);
        $categories = Category::whereIn('id',$cats)->get();
        $num_products = $category->no_of_products;
        $sale_products = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);
        if(Auth::check()){
            Cart::instance('cart')->restore(Auth::user()->email);
        }
        return view('livewire.home-component',['slider' => $slider,'lproducts' => $lproducts,'categories' => $categories,'num_products' => $num_products,'sale_products'=>$sale_products,'sale' => $sale])->layout('layouts.base');
    }
}
