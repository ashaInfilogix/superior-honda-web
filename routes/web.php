<?php

Use App\Http\Controllers\ProductController;
Use App\Http\Controllers\AuthController;
Use App\Http\Controllers\WishlistController;
Use App\Http\Controllers\DashboardController;
Use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');

Route::get('/', function (){
    return view('index');
})->name('index');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::resources([
        'dashboard' => DashboardController::class,
        'profile'   => ProfileController::class,
        'addresses' => AddressController::class,
        'vehicles'  => VehicleController::class,
    ]);

    /************** Wishlist*****************/
});

Route::resources([
    'wishlists' => WishlistController::class,
    'products'  => ProductController::class,
    'services'  => ServiceController::class,
    'inquiries' => InquiryController::class,
    ]);
Route::post('wishlists.add-and-remove', [WishlistController::class, 'wishlistAddRemove'])->name('wishlists.add-and-remove');

Route::get('/category-products/{category_id}', [ProductController::class, 'categoryProduct'])->name('products.category-products');

Route::get('/states/{country_id?}', [AddressController::class, 'getStates'])->name('addresses.getStates');
//Route::view('/add-new-address','profile.add-address')->name('profile.addnewaddress');

/* Routes for Ajax calls */
Route::post('get-vehicle-brand', [ VehicleController::class, 'getVehicleBrand']);  // get vechicle brands according to category
Route::post('get-vehicle-model', [ VehicleController::class, 'getVehicleModel']); // get vechicle models according to category
Route::post('get-vehicle-model-variant', [VehicleController::class, 'getVehicleModelVariant']); //get vehicle model variant through model.

/*******  Add To Cart  **********/
Route::get('cart', [CartController::class, 'index'])->name('cart');  
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('update-cart', [CartController::class, 'update'])->name('update-cart');
Route::post('remove-from-cart', [CartController::class, 'remove'])->name('remove-from-cart'); 
Route::post('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::post('coupon-code', [CartController::class, 'couponCode'])->name('coupon-code');

Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('order', [CartController::class, 'order'])->name('order');

// Route::post('wishlist', [WishlistController::class, 'wishlistAddRemove'])->name('wishlist');  // product add and remove


