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


Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [aboutController::class, 'about'])->name('about');
Route::get('/blog', [blogController::class, 'blog'])->name('blog');
Route::get('/cart', [cartController::class, 'cart'])->name('cart');
Route::get('/checkout', [checkoutController::class, 'checkout'])->name('checkout');
Route::get('/contact', [contactController::class, 'contact'])->name('contact');
Route::get('/profile', [profileController::class, 'profile'])->name('profile');
Route::get('/shop', [shopController::class, 'shop'])->name('shop');
Route::get('/shopDetail', [shopDetailsController::class, 'shopDetail'])->name('shopDetail');
Route::get('/singlePost', [singlePostController::class, 'singlePost'])->name('singlePost');
Route::get('/singleportfolio', [singleprotfolioController::class, 'singleportfolio'])->name('singleportfolio');
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
});
// Categories Route
Route::get('/categories', [categoriesController::class, 'categories'])->name('categories');
Route::post('/Add/Categories', [categoriesController::class, 'store'])->name('addcategories');

// view Route

Route::prefix('admin/categoy')->group(function () {
    // Categories Route
    Route::get('/show', [CategoriesController::class, 'categories'])->name('categories');
    Route::post('/Add', [CategoriesController::class, 'store'])->name('addcategories');

    // View Route
    Route::get('/view', [CategoriesController::class, 'view'])->name('showcategories');

    // Update Route
    Route::get('/update/{id}', [CategoriesController::class, 'update'])->name('updatecategories');
    Route::put('/Edit', [CategoriesController::class, 'putcategories'])->name('editcategories');

    // Delete Route
    Route::get('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('deletecategories');
});

// Product Route
Route::get('/product', [productController::class, 'product'])->name('product');
Route::post('/Add/Product', [productController::class, 'store'])->name('addproduct');

// view Route
Route::get('/showproduct', [productController::class, 'view'])->name('showproduct');

// update Route
Route::get('/updateproduct/{id}', [productController::class, 'update'])->name('updateproduct');
Route::put('/editproduct', [productController::class, 'putproduct'])->name('editproduct');
// delete Route
Route::get('/destroy/product/{id}', [productController::class, 'destroy'])->name('deleteproduct');

require __DIR__.'/auth.php';
