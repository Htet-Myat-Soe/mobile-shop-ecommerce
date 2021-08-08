<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin.admin-product-component',['products' => $products])->layout('layouts.admin-base');
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        if($product->image){
            unlink('assets/images/products'.'/'.$product->image);
        }

        if($product->images){
            $images = explode(",",$product->images);
            foreach($images as $image){
                unlink('assets/images/products'.'/'.$product->image);
            }
        }

        session()->flash('message','Product Deleted Successfully');
    }
}
