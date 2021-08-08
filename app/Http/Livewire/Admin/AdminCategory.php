<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminCategory extends Component
{
    public $name;
    public $slug;
    public $ids;
    public function slugGenerate(){
        $this->slug = Str::of($this->name)->slug();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->slug = '';
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
    }
    public function storeCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message','Category Add Successfully');
        $this->emit('createSuccess');
        $this->resetInputFields();
    }
    public function edit($id){
        $cat = Category::find($id);
        $this->name = $cat->name;
        $this->slug = $cat->slug;
        $this->ids = $cat->id;
    }

    public function updateCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $cat = Category::find($this->ids);
        $cat->update([
            'name' => $this->name,
            'slug' => $this->slug
        ]);
        session()->flash('message' , 'Category Updated Successfully');
        $this->emit('updateSuccess');

        $this->resetInputFields();
    }

    public function delete($id){
        $cat = Category::find($id);
        $cat->delete();
        session()->flash('message','Category Deleted Successfully');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-category',['categories'=>$categories])->layout('layouts.admin-base');
    }
}
