<?php

use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\Admin\AdminCategory;
use App\Http\Livewire\Admin\AdminAddCouponsComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCouponsComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderAddComponent;
use App\Http\Livewire\Admin\AdminHomeSliderEditComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminProductAdd;
use App\Http\Livewire\Admin\AdminProductEditComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePassword;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrderComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\WishListComponent;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',HomeComponent::class);
Route::get('/shop',ShopComponent::class)->name('shop');
Route::get('/details/{slug}',DetailsComponent::class)->name('details');
Route::get('/cart',CartComponent::class)->name('cart');
Route::get('/category/{slug}',CategoryComponent::class)->name('category');
Route::get('/search',SearchComponent::class)->name('search');
Route::get('/wishlist',WishListComponent::class)->name('wishlist');
Route::get('/checkout',CheckoutComponent::class)->name('checkout');
Route::get('/thankyou',ThankyouComponent::class)->name('thankyou');
Route::get('/contact-us',ContactComponent::class)->name('contact');
Route::get('/about-us',AboutComponent::class)->name('about');
// Customer Route

Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders',UserOrderComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}',UserOrderDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',UserChangePassword::class)->name('user.changepassword');
});


// Admin Route

Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories',AdminCategory::class)->name('admin.categories');
    Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add',AdminProductAdd::class)->name('admin.productAdd');
    Route::get('/admin/product/edit/{product_slug}',AdminProductEditComponent::class)->name('admin.productEdit');

    Route::get('/admin/home-slider',AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/home-slider/add',AdminHomeSliderAddComponent::class)->name('admin.homeslideradd');
    Route::get('/admin/home-slider/edit/{slider_id}',AdminHomeSliderEditComponent::class)->name('admin.homeslideredit');

    Route::get('/admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');
    Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale_date');

    Route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('/admin/coupons/add',AdminAddCouponsComponent::class)->name('admin.addcoupons');
    Route::get('/admin/coupons/edit/{coupon_id}',AdminEditCouponsComponent::class)->name('admin.editcoupons');

    Route::get('/admin/orders',AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/orders/{order_id}',AdminOrderDetailComponent::class)->name('admin.orderdetails');

    Route::get('/admin/contact',AdminContactComponent::class)->name('admin.contact');

    Route::get('/admin/settings',AdminSettingComponent::class)->name('admin.settings');
});
