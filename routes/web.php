<?php

use App\Http\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');

// });

Auth::routes();

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections',[App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}',[App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}',[App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class,'index']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //category route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{id}','update');
    });

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function (){
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products','store');
        Route::get('/products/{product}/edit','edit');
        Route::put('/products/{product}','update');
        Route::get('/products/{product_id}/delete','destroy');
        Route::get('/product-image/{product_image_id}/delete','destroyImage');
        Route::post('product-color/{prod_color_id}','updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete','deleteProdColor');
    });

    Route::get('/brands',App\Livewire\Admin\Brand\index::class);
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function (){
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create','store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');


    });
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function (){
        Route::get('sliders','index');
        Route::get('sliders/create','create');
        Route::post('sliders/create','store');
        Route::get('sliders/{slider}/edit','edit');
        Route::put('sliders/{slider}','update');
        Route::get('sliders/{slider}/delete','destroy');

    });

});
        //Livewire::component('admin.brand.index', Index::class);

/**
 * Customer URLs
 */
Route::get('customer', function(){
    return view('customer.index');
});
Route::prefix('customer')->group(function(){
    Route::controller(App\Http\Controllers\CustomerController::class)->group(function () {
        Route::get('shop', 'getShop')->name('customer.shop');
        Route::get('about', 'getAbout')->name('customer.about');
        Route::get('services', 'getServices')->name('customer.services');
        Route::get('blog', 'getBlog')->name('customer.blog');
        Route::get('contact', 'getContact')->name('customer.contact');
        Route::get('cart', 'getCart')->name('customer.cart');
        Route::get('checkout', 'getCheckout')->name('customer.checkout');
        Route::get('thankyou', 'getThankyou')->name('customer.thankyou');
    });
});
