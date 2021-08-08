<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public function render()
    {
        $home_slider = HomeSlider::all();
        return view('livewire.admin.admin-home-slider-component',['home_sliders' => $home_slider])->layout('layouts.admin-base');
    }

    public function delete($id){
        HomeSlider::find($id)->delete();
        session()->flash('message','Slider Deleted Successfully');
    }
}
