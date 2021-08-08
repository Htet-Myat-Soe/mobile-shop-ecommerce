<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
class AdminHomeSliderEditComponent extends Component
{

    use WithFileUploads;
    public $title;
    public $subtitle;
    public $url;
    public $price;
    public $image;
    public $status;
    public $newImage;
    public $ids;

    public function mount($slider_id){
        $slide = HomeSlider::where('id',$slider_id)->first();
        $this->ids = $slide->id;
        $this->title = $slide->title ;
        $this->subtitle = $slide->subtitle;
        $this->price = $slide->price ;
        $this->url = $slide->url ;
        $this->image = $slide->image ;
        $this->status = $slide->status ;
    }

    public function resetForm(){
        $this->title = '';
        $this->subtitle = '';
        $this->url = '';
        $this->price = '';
        $this->newImage = '';
        $this->status = '';
        $this->ids = '';
    }

    public function update(){
        $home_slider = HomeSlider::find($this->ids);
        $home_slider->title = $this->title;
        $home_slider->subtitle = $this->subtitle;
        $home_slider->price = $this->price;
        $home_slider->url = $this->url;
        dd($this->newImage);
        if($this->newImage){
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('products',$imageName);
            $home_slider->image = $imageName;

        }
        $home_slider->status = $this->status;
        $home_slider->save();
        session()->flash('message','Home Slider Updated Successfully');
        $this->resetForm();

    }

    public function render()
    {
        return view('livewire.admin.admin-home-slider-edit-component')->layout('layouts.admin-base');
    }
}
