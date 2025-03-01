<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\BlogDetailController;
use App\Http\Controllers\Frontend\BlogListController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\MyProductController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //route của profile user
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile', [UserController::class, 'update']);

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    //route của country
    Route::get('/country', [CountryController::class, 'index'])->name('country');

    Route::get('/country/add', [CountryController::class, 'add'])->name('add-country');
    Route::post('/country/add', [CountryController::class, 'create'])->name('add-country');

    Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('edit-country');
    Route::post('/country/edit/{id}', [CountryController::class, 'update'])->name('edit-country');

    Route::get('/country/delete/{id}', [CountryController::class, 'destroy'])->name('delete-country');


    // route của blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::get('/blog/add', [BlogController::class, 'add'])->name('add-blog');
    Route::post('/blog/add', [BlogController::class, 'create'])->name('add-blog');

    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('edit-blog');
    Route::post('/blog/edit/{id}', [BlogController::class, 'update'])->name('edit-blog');

    Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('delete-blog');


});


// Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//Frontend
Route::group([
    'middleware' => ['member']
], function () {

    Route::get('/member/logout', [LoginController::class, 'logout']);

    //rate blog
    Route::post('/blog/detail/{id}/rate', [BlogDetailController::class, 'rateBlog']);

    //account
    Route::get('/member/account', [AccountController::class, 'index'])->name('account');
    Route::post('/member/account', [AccountController::class, 'update'])->name('account');

    Route::get('/member/account/my-product', [MyProductController::class, 'index'])->name('account.my-product');

    Route::get('/member/account/add-product', [MyProductController::class, 'create'])->name('account.add-product');
    Route::post('/member/account/add-product', [MyProductController::class, 'add'])->name('account.add-product');

    Route::get('/member/account/edit-product/{id}', [MyProductController::class, 'edit'])->name('account.edit-product');
    Route::post('/member/account/edit-product/{id}', [MyProductController::class, 'update'])->name('account.edit-product');

    Route::get('/member/account/delete-product/{id}', [MyProductController::class, 'destroy'])->name('account.delete-product');


    //thêm cmt
    Route::post('/blog/detail/{id}/comment', [BlogDetailController::class, 'createCmt']);


    //cart
    Route::get('/update-qty', [CartController::class, 'getCartQty'])->name('update-qty');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'store'])->name('add-to-cart');
    Route::post('/cart/delete-product/{id}', [CartController::class, 'destroy'])->name('delete-cart');
    Route::post('/cart/qty-up/{id}', [CartController::class, 'upCartQty'])->name('up-cart-qty');
    Route::post('/cart/qty-down/{id}', [CartController::class, 'downCartQty'])->name('down-cart-qty');


    //test send mail
    // Route::get('/test', [MailController::class, 'index']);

    //checkout
    Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('cart-checkout');
    Route::get('/cart/checkout/send-mail', [CheckoutController::class, 'mailIndex'])->name('cart-send-mail');

});

Route::group([
    'middleware' => ['memberIsLogin']
], function () {
    Route::get('/member/register', [RegisterController::class, 'index'])->name('member.register');
    Route::post('/member/register', [RegisterController::class, 'create'])->name('member.register');

    Route::get('/member/login', [LoginController::class, 'index'])->name('member.login');
    Route::post('/member/login', [LoginController::class, 'login'])->name('member.login');
});

Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/blog/list', [BlogListController::class, 'index'])->name('blog-list');

Route::get('/blog/detail/{id}', [BlogDetailController::class, 'index'])->name('blog');

//detail product
Route::get('/product-detail/{id}', [ProductDetailController::class, 'index'])->name('product-detail');

//search
Route::post('/search-product', [SearchController::class, 'index'])->name('search-product');

Route::get('/search-advanced', [SearchController::class, 'indexSearchAdvanced'])->name('search-advanced');
Route::post('/search-advanced', [SearchController::class, 'indexSearchAdvanced'])->name('search-advanced');

// Route::get('/search-price', [SearchController::class, 'indexSearchPrice'])->name('search-price');
Route::post('/search-price', [SearchController::class, 'SearchPrice'])->name('search-price');
Route::get('/search-price', [SearchController::class, 'indexSearchPrice'])->name('search-price');







