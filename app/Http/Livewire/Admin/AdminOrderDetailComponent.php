<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Sale;
use Livewire\Component;

class AdminOrderDetailComponent extends Component
{
    public $order_id;
    public function mount($order_id){
        $this->order_id = $order_id;
    }
    public function render()
    {
        $orders = Order::find($this->order_id);
        $sale = Sale::find(1);
        return view('livewire.admin.admin-order-detail-component',['orders' => $orders,'sale' => $sale])->layout('layouts.admin-base');
    }
}
