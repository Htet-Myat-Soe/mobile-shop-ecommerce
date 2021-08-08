<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class CartComponent extends Component
{

    public $haveCouponCode;
    public $coupon_code;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function mount(){
        $this->subtotalAfterDiscount = filter_var($this->subtotalAfterDiscount,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        $this->taxAfterDiscount = filter_var($this->taxAfterDiscount,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        $this->totalAfterDiscount = filter_var($this->totalAfterDiscount,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    }
    public function increaseQty($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    }
    public function decreaseQty($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    }


    public function delete($rowId){
        Cart::instance('cart')->remove($rowId);
        session()->flash('message','Cart Deleted Successfully !');
        $this->emitTo('cart-count-component','refreshComponent');

    }

    public function saveForLater($rowId){
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('message','Item have been saved successfully');
    }

    public function deleteSaveForLater($rowId){
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('message','Item have been removed successfully');
    }

    public function moveToCart($rowId){
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('message','Move to cart successfully');

    }

    public function applyCouponCode(){
        $coupon = Coupon::where('code',$this->coupon_code)->where('cart_value','<=',Cart::instance('cart')->subtotal())->where('expiry_date','>=',Carbon::today())->first();
        if(!$coupon){
            session()->flash('message','Coupon Code is invalid');
            return;
        }

        session()->put('coupon',[
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value,
        ]);

    }

    public function calculateDiscounts(){
      if(session()->has('coupon')){
          if(session()->get('coupon')['type'] == 'fixed'){
            $this->discount = session()->get('coupon')['value'];
          }
          else{
            $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value'])/100;
          }
          $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() -  $this->discount;
          $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax'))/100;
          $this->totalAfterDiscount =  $this->subtotalAfterDiscount + $this->taxAfterDiscount;
      }
    }

    public function removeCoupon(){
        session()->forget('coupon');
    }

    public function checkout(){
        if(Auth::check()){
            return redirect()->route('checkout');
        }
        else{
            return redirect()->route('login');
        }
    }
    public function setAmountForCheckout(){
        if(!Cart::instance('cart')->count() > 0){
            session()->forget('checkout');
            return;
        }
        if(session()->has('coupon')){
            session()->put('checkout',[
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }
        else{
            session()->put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }
    public function render()
    {
        if(session()->has('coupon')){
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']){
                session()->forget('coupon');
            }
            else{
                $this->calculateDiscounts();
            }
        }

        $this->setAmountForCheckout();
        $sale = Sale::find(1);

        if(Auth::check()){
            Cart::instance('cart')->restore(Auth::user()->email);
        }
        return view('livewire.cart-component',['sale' => $sale])->layout('layouts.base');
    }



}
