<?php

use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\WishlistController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);
Route::get('/collections',[FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}',[FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}',[FrontendController::class, 'productView']);
Route::get('/collections/{category_slug}/{product_slug}/{colorId}',[FrontendController::class, 'productView']);
Route::post('/add-cart',[FrontendController::class, 'storecart']);
Route::get('/new-arrivals', [FrontendController::class, 'newArrival']);
Route::get('/featured-products', [FrontendController::class, 'featuredProducts']);
Route::get('/search', [FrontendController::class, 'searchProducts']);

// WishLIst
Route::post('/add-wishlist',[WishlistController::class, 'storewishlist']);

// Thank you
Route::get('/thank-you',[FrontendController::class, 'thankyou']);



// Route::get('/home', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist',[WishlistController::class, 'index']);
    Route::get('/nav-wishlist',[WishlistController::class, 'checkWishlistCount']);
    Route::delete('/remove-wishlist',[WishlistController::class, 'removewishlist']);

    Route::get('/cart',[CartController::class, 'index']);
    Route::get('/nav-cart',[CartController::class, 'checkCartCount']);
    Route::post('/update-cart-quantity/{itemId}',[CartController::class, 'update']);
    Route::delete('/remove-cart',[CartController::class, 'removecart']);

    Route::get('/checkout',[CheckoutController::class, 'index']);
    Route::post('/place-order',[CheckoutController::class, 'placeOrder']);
    Route::post('/paid-online-order',[CheckoutController::class, 'paidOnlineOrder']);

    Route::get('/orders',[OrderController::class, 'index']);
    Route::get('/orders/{orderId}',[OrderController::class, 'show']);

    Route::get('/profile',[FrontendUserController::class, 'index']);
    Route::post('/profile',[FrontendUserController::class, 'updateUserDetails']);

    
    Route::get('/change-password',[FrontendUserController::class, 'passwordCreate']);
    Route::post('/change-password',[FrontendUserController::class, 'changePassword']);


});

Route::middleware('admin')->group(function(){
    Route::get('/admin/dashboard',[DashboardController::class,'adminDashboard']);
    
    Route::get('/admin/category',[CategoryController::class,'adminCategory']);
    Route::get('/admin/category/create',[CategoryController::class,'create']);
    Route::post('/admin/category',[CategoryController::class,'store']);
    Route::get('/admin/category/{category}/edit',[CategoryController::class,'edit']);
    Route::put('/admin/category/{category}',[CategoryController::class,'update']);
    Route::delete('/admin/category/{category}',[CategoryController::class,'destory']);

    Route::get('/admin/brand',[BrandController::class,'adminBrand']);
    Route::get('/admin/brand/create',[BrandController::class,'create']);
    Route::post('/admin/brand',[BrandController::class,'store']);
    Route::get('/admin/brand/{brand}/edit',[BrandController::class,'edit']);
    Route::put('/admin/brand/{brand}',[BrandController::class,'update']);
    Route::delete('/admin/brand/{brand}',[BrandController::class,'destory']);

    Route::get('/admin/product',[ProductController::class,'adminProduct']);
    Route::get('/admin/product/create',[ProductController::class,'create']);
    Route::post('/admin/product',[ProductController::class,'store']);
    Route::get('/admin/product/{product}/edit',[ProductController::class,'edit']);
    Route::put('/admin/product/{product}',[ProductController::class,'update']);
    Route::delete('/admin/product/{product}',[ProductController::class,'destory']);
    Route::get('/admin/product-image/{product_image_id}/delete',[ProductController::class,'destoryImage']);
    Route::post('/admin/product-color/{prod_color_id}',[ProductController::class,'updateProdColorQty']);
    Route::get('/admin/product-color/{prod_color_id}/delete',[ProductController::class,'deleteProdColorQty']);


    Route::get('/admin/color',[ColorController::class,'adminColor']);
    Route::get('/admin/color/create',[ColorController::class,'create']);
    Route::post('/admin/color',[ColorController::class,'store']);
    Route::get('/admin/color/{color}/edit',[ColorController::class,'edit']);
    Route::put('/admin/color/{color}',[ColorController::class,'update']);
    Route::delete('/admin/color/{color}',[ColorController::class,'destory']);

    Route::get('/admin/slider',[SliderController::class,'adminSlider']);
    Route::get('/admin/slider/create',[SliderController::class,'create']);
    Route::post('/admin/slider',[SliderController::class,'store']);
    Route::get('/admin/slider/{slider}/edit',[SliderController::class,'edit']);
    Route::put('/admin/slider/{slider}',[SliderController::class,'update']);
    Route::delete('/admin/slider/{slider}',[SliderController::class,'destory']);

    Route::get('/admin/orders',[AdminOrderController::class,'index']);
    Route::get('/admin/orders/{orderId}',[AdminOrderController::class,'show']);
    Route::put('/admin/orders/{orderId}',[AdminOrderController::class,'updateOrderStatus']);
    Route::get('/admin/invoice/{orderId}',[AdminOrderController::class,'viewInvoice']);
    Route::get('/admin/invoice/{orderId}/generate',[AdminOrderController::class,'generateInvoice']);
    Route::get('/admin/invoice/{orderId}/mail',[AdminOrderController::class,'mailInvoice']);


    Route::get('/admin/settings',[SettingController::class,'index']);
    Route::post('/admin/settings',[SettingController::class,'store']);

    Route::get('/admin/users',[UserController::class,'index']);
    Route::get('/admin/users/create',[UserController::class,'create']);
    Route::post('/admin/users',[UserController::class,'store']);
    Route::get('/admin/users/{user_id}/edit',[UserController::class,'edit']);
    Route::put('/admin/users/{user_id}',[UserController::class,'update']);
    Route::delete('/admin/users/{user_id}',[UserController::class,'destory']);


});



require __DIR__.'/auth.php';

// Route::prefix('admin')->group(function(){
//     Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);
// });


