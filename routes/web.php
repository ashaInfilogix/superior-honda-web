<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

//Login Register Routes
Route::middleware('cors_middleware')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    //Forgot Password Routes
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');

    Route::get('/', [HomeController::class, 'showHomePage'])->name('index');

    Route::middleware(['auth', 'auth.session'])->group(function () {
        Route::resources([
            'dashboard' => DashboardController::class,
            'profile'   => ProfileController::class,
            'addresses' => AddressController::class,
            'vehicles'  => VehicleController::class,
        ]);
    });

    Route::post('wishlists.add-and-remove', [WishlistController::class, 'wishlistAddRemove'])->name('wishlists.add-and-remove');

    Route::resources([
        'wishlists' => WishlistController::class,
        'products'  => ProductController::class,
        'services'  => ServiceController::class,
        'inquiries' => InquiryController::class,
    ]);

    Route::get('/category-products/{category_id}', [ProductController::class, 'categoryProduct'])->name('products.category-products');

    Route::get('/states/{country_id?}', [AddressController::class, 'getStates'])->name('addresses.getStates');

    /* Routes for Ajax calls */
    Route::post('get-vehicle-brand', [VehicleController::class, 'getVehicleBrand']);  // get vehicle brands according to category
    Route::post('get-vehicle-model', [VehicleController::class, 'getVehicleModel']); // get vehicle models according to category
    Route::post('get-vehicle-model-variant', [VehicleController::class, 'getVehicleModelVariant']); // get vehicle model variant through model.

    /******  Add To Cart  *********/
    Route::get('cart', [CartController::class, 'index'])->name('cart');  
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('update-cart', [CartController::class, 'update'])->name('update-cart');
    Route::post('remove-from-cart', [CartController::class, 'remove'])->name('remove-from-cart'); 
    Route::post('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
    Route::post('coupon-code', [CartController::class, 'couponCode'])->name('coupon-code');

    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('order', [CartController::class, 'order'])->name('order');
    Route::get('order-confirm', [CartController::class, 'orderConfirm'])->name('order-confirm');

    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::POST('create-transaction-card', [PayPalController::class, 'createTransaction'])->name('createTransactionCard');
    Route::get('capture-transaction', [PayPalController::class, 'captureTransaction'])->name('captureTransaction');
    Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
    Route::get('test-payment', function(){
        return view("test.test-payment");
    });
    Route::get('test-paypal', function(){
        return view("test.test-paypal");
    });

    Route::get('accesories', [ProductController::class, 'accesories'])->name('accesories');

    Route::post('/products/{product}/reviews', [ReviewController::class,'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
});

/*
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
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
//Login Register Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Forgot Password Routes
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');

Route::get('/',[HomeController::class,'showHomePage'])->name('index');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::resources([
        // 'wishlists' => WishlistController::class,
        'dashboard' => DashboardController::class,
        'profile'   => ProfileController::class,
        'addresses' => AddressController::class,
        'vehicles'  => VehicleController::class,
    ]);

    /************** Wishlist****************
    
});
Route::post('wishlists.add-and-remove', [WishlistController::class, 'wishlistAddRemove'])->name('wishlists.add-and-remove');

Route::resources([
    'wishlists' => WishlistController::class,
    'products'  => ProductController::class,
    'services'  => ServiceController::class,
    'inquiries' => InquiryController::class,
]);

Route::get('/category-products/{category_id}', [ProductController::class, 'categoryProduct'])->name('products.category-products');

Route::get('/states/{country_id?}', [AddressController::class, 'getStates'])->name('addresses.getStates');
//Route::view('/add-new-address','profile.add-address')->name('profile.addnewaddress');

/* Routes for Ajax calls 
Route::post('get-vehicle-brand', [ VehicleController::class, 'getVehicleBrand']);  // get vechicle brands according to category
Route::post('get-vehicle-model', [ VehicleController::class, 'getVehicleModel']); // get vechicle models according to category
Route::post('get-vehicle-model-variant', [VehicleController::class, 'getVehicleModelVariant']); //get vehicle model variant through model.

/******  Add To Cart  ********
Route::get('cart', [CartController::class, 'index'])->name('cart');  
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('update-cart', [CartController::class, 'update'])->name('update-cart');
Route::post('remove-from-cart', [CartController::class, 'remove'])->name('remove-from-cart'); 
Route::post('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::post('coupon-code', [CartController::class, 'couponCode'])->name('coupon-code');

Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('order', [CartController::class, 'order'])->name('order');

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::POST('create-transaction-card', [PayPalController::class, 'createTransaction'])->name('createTransactionCard');
Route::get('capture-transaction', [PayPalController::class, 'captureTransaction'])->name('captureTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('test-payment' ,function(){
    return view("test.test-payment");
});
Route::get('test-paypal' ,function(){
    return view("test.test-paypal");
});
*/