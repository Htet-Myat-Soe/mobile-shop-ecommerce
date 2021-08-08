<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;
class AdminProductEditComponent extends Component
{
    public $name;
    public $slug;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock;
    public $category_id;
    public $short_desc;
    public $desc;
    public $image;
    public $qty;
    public $newImage;
    public $product_id;
    public $images;
    public $newImages;
    public function resetForm(){
        $this->name = '';
        $this->slug = '';
        $this->regular_price = '';
        $this->sale_price = '';
        $this->sku = '';
        $this->stock = '';
        $this->category_id = '';
        $this->short_desc = '';
        $this->desc = '';
        $this->image = '';
        $this->qty = '';
        $this->product_id = '';

    }
    use WithFileUploads;

    public function mount($product_slug){
        $product = Product::where('slug',$product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->SKU;
        $this->stock = $product->stock_status;
        $this->category_id = $product->category_id;
        $this->short_desc = $product->short_description;
        $this->desc = $product->description;
        $this->image = $product->image;
        $this->images = explode(",",$product->images);
        $this->qty = $product->quantity;
        $this->product_id = $product->id;
        }

    public function slugGenerate(){
        $this->slug = Str::of($this->name)->slug();
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'regular_price' => 'required',
            'sku' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'qty' => 'required',
        ]);
    }
    public function updateProduct(){
        $this->validate([
            'name' => 'required',
            'regular_price' => 'required',
            'sku' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'qty' => 'required',
        ]);
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->short_description = $this->short_desc;
        $product->description = $this->desc;
        if($this->newImage){
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('products',$imageName);
            $product->image = $imageName;

        }

        if($this->newImages){
            if($product->images){
                $images = explode(",",$product->images);
                foreach($images as $image){
                    if($image){
                        unlink('assets/images/products'.'/'.$image);
                    }
                }
            }

            $imagesname = '';
            foreach($this->newImages as $key => $image){
                $imgName = Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesname .= ','.$imgName;
            }
            $product->images = $imagesname;
        }
        $product->quantity = $this->qty;
        $product->category_id = $this->category_id;

        $product->save();
        session()->flash('message','Product Updated Successfully');
        $this->resetForm();
        return redirect()->route('admin.products');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-product-edit-component',['categories' => $categories])->layout('layouts.admin-base');
    }
}
