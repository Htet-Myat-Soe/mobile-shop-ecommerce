<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
class AdminEditCouponsComponent extends Component
{

    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    public $expiry_date;
    public function mount($coupon_id){
        $this->coupon_id = $coupon_id;
        $coupon = Coupon::find($this->coupon_id);
        $this->code = $coupon->code;
        $this->value = $coupon->value;
        $this->type = $coupon->type;
        $this->cart_value = $coupon->cart_value;
        $this->expiry_date = $coupon->expiry_date;
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required'

        ]);
    }
    public function update(){
        $this->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required'

        ]);
        $coupon = Coupon::find($this->coupon_id);
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;

        $coupon->save();
        session()->flash('message','Coupon Add Successfully');

    }
    public function render()
    {
        return view('livewire.admin.admin-edit-coupons-component')->layout('layouts.admin-base');
    }
}
