<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $users = User::where('utype','User')->get()->take(5);
        $orders = Order::orderBy('created_at','DESC')->get()->take(10);
        $totalSales = Order::where('status','delivered')->count();
        $totalRevenue = Order::where('status','delivered')->sum('total');
        $todaySales = Order::where('status','delivered')->where('created_at',Carbon::now()->today())->count();
        $todayRevenue = Order::where('status','delivered')->where('created_at',Carbon::now()->today())->sum('total');
        return view('livewire.admin.admin-dashboard-component',['users' => $users,'orders' => $orders,'totalSales' => $totalSales,'totalRevenue' => $totalRevenue,'todaySales' => $todaySales,'todayRevenue' => $todayRevenue])->layout('layouts.admin-base');
    }
}
