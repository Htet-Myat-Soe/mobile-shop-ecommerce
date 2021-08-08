<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $sel_categories = [];
    public $num_products;

    public function mount(){
        $category = HomeCategory::find(1);
        $this->sel_categories = explode(',',$category->sel_categories);
        $this->num_products = $category->no_of_products;

    }

    public function updateHomeCategory(){
        $category = HomeCategory::find(1);
        $category->sel_categories = implode(',',$this->sel_categories);
        $category->no_of_products = $this->num_products;
        $category->save();
        session()->flash('message','Home Category Updated Successfully');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component',['categories' => $categories])->layout('layouts.admin-base');
    }
}
