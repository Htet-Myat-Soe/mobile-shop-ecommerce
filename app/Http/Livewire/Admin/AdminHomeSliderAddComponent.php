<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;
class AdminHomeSliderAddComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $url;
    public $price;
    public $image;
    public $status;

    public function mount(){
        $this->status = 0;
    }

    public function resetForm(){
        $this->title = '';
        $this->subtitle = '';
        $this->url = '';
        $this->price = '';
        $this->image = '';
        $this->status = '';
    }

    public function store(){
        $home_slider =new HomeSlider();
        $home_slider->title = $this->title;
        $home_slider->subtitle = $this->subtitle;
        $home_slider->price = $this->price;
        $home_slider->url = $this->url;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $home_slider->image = $imageName;
        $home_slider->status = $this->status;
        $home_slider->save();
        session()->flash('message','Home Slider Created Successfully');
        $this->resetForm();
    }
    public function render()
    {
        return view('livewire.admin.admin-home-slider-add-component')->layout('layouts.admin-base');
    }
}
