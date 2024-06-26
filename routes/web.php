<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\aboutController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\shopDetailsController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\singlePostController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\singleprotfolioController;
use App\Http\Controllers\Auth\categoriesController;
use App\Http\Controllers\Auth\productController;
use App\Http\Controllers\StripeController;



Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [aboutController::class, 'about'])->name('about');
Route::get('/blog', [blogController::class, 'blog'])->name('blog');
Route::get('/cart', [cartController::class, 'cart'])->name('cart');
Route::get('/checkout', [checkoutController::class, 'checkout'])->name('checkout');
Route::get('/profile', [profileController::class, 'profile'])->name('profile');
Route::get('/singlePost', [singlePostController::class, 'singlePost'])->name('singlePost');

Route::post('/addtocart', [cartController::class, 'addtocart'])->name('addtocart');
Route::post('/add_cart_with_total', [cartController::class, 'add_cart_with_total'])->name('add_cart_with_total');

Route::post('/sub_cart_with_total', [cartController::class, 'sub_cart_with_total'])->name('sub_cart_with_total');
Route::get('/deleteCart/{id}', [cartController::class, 'deleteCart'])->name('deleteCart');

Route::get('/singleportfolio', [singleprotfolioController::class, 'singleportfolio'])->name('singleportfolio');


// All Contact Route Start
    Route::get('/contact', [contactController::class, 'contact'])->name('contact');
    Route::post('/contactStore', [contactController::class, 'contactStore'])->name('contactStore');
// All Contact Route End

// All Shop Route Start
    Route::get('/shop/{id}', [shopController::class, 'shop'])->name('shopid');
    Route::get('/shop', [shopController::class, 'shop'])->name('shop');
    Route::get('/shopDetail/{id}', [shopDetailsController::class, 'shopDetail'])->name('shopDetail');
    Route::get('/FetchAllProduct', [shopController::class, 'getproduct']);
    Route::get('/FetchProductWithId/{value}', [shopController::class, 'getproduct'])->name('FetchProductWithId');
   
// All Shop Route End

Route::get('/index', function () {
    return view('welcome');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admindashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('admindashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Categories Route
    Route::prefix('admin/category')->group(function () {
        // Categories Route
        Route::get('/Show', [CategoriesController::class, 'categories'])->name('categories');
        Route::post('/Add', [CategoriesController::class, 'store'])->name('addcategories');

        // View Route
        Route::get('/view', [CategoriesController::class, 'view'])->name('showcategories');

        // Update Route
        Route::get('/Update/{id}', [CategoriesController::class, 'update'])->name('updatecategories');
        Route::put('/Edit', [CategoriesController::class, 'putcategories'])->name('editcategories');

        // Delete Route
        Route::get('/Destroy/{id}', [CategoriesController::class, 'destroy'])->name('deletecategories');
         Route::get('/Show', [CategoriesController::class, 'categories'])->name('categories');
    });

    // Product Route

    Route::prefix('admin/product')->group(function () {

        Route::get('/Show', [productController::class, 'product'])->name('product');
        Route::post('/Add', [productController::class, 'store'])->name('addproduct');
        
        // view Route
        Route::get('/View', [productController::class, 'view'])->name('showproduct');
        
        // update Route
        Route::get('/Update/{id}', [productController::class, 'update'])->name('updateproduct');
        Route::put('/Edit', [productController::class, 'putproduct'])->name('editproduct');
        // delete Route
        Route::get('/Destroy/{id}', [productController::class, 'destroy'])->name('deleteproduct');
        
    });
});




// Stripe Route
Route::get('stripe', [StripeController::class, 'index'])->name('stripe');
Route::post('stripe/create-charge', [StripeController::class, 'createCharge'])->name('stripe.create-charge');



require __DIR__.'/auth.php';
