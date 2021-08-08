<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminProductAdd extends Component
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
    public $images = [];

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


    }
    use WithFileUploads;

    public function mount(){
        $this->stock = 'instock';
    }
    public function slugGenerate(){
        return Str::slug($this->name);
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
    public function storeProduct(){
        $this->validate([
            'name' => 'required',
            'regular_price' => 'required',
            'sku' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'qty' => 'required',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slugGenerate();
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->sku;
        $product->short_description = $this->short_desc;
        $product->description = $this->desc;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image = $imageName;
        $product->quantity = $this->qty;
        $product->category_id = $this->category_id;

        if($this->images){
            $imagesname = '';
            foreach($this->images as $key => $image){
                $imgName = Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesname .= ','.$imgName;
            }
        $product->images = $imagesname;
        }

        $product->save();
        session()->flash('message','Product Created Successfully');
        $this->resetForm();
        $this->emit('createdSuccess');


    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-product-add',['categories' => $categories])->layout('layouts.admin-base');
    }
}
