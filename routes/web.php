<?php

use App\Domain;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Carts2Controller;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\commentController;
use App\Http\Controllers\Frontend\MtcommentController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Backend\WishlistController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();
$getHost = request()->getHost();
$getPathInfo = request()->getPathInfo();
$demo = '';
if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir' or $getHost == 'www.ishopsazfa.ir' or $getHost == 'localhost' or $getHost == 'localhost:8000') {
    $title = str_replace("/", "", $getPathInfo);
    $path = explode('/', $getPathInfo);
    if (!empty($path[1])) {
        $shopQ = Shop::where('title_en', $path[1])->first();
        if (empty($shopQ)) {
            dd('فروشگاهی با این نام یافت نشد');
        } else {
            $shop = $shopQ->id;
            $demo = $path[1];
        }
    } else {
        $shop = '2';
    }
}

if (!empty($demo)) {

    Route::get($demo . '/register', [RegisterController::class, 'showRegistrationForm'])->name('demo.register');
    Route::post($demo . '/register', [UserController::class, 'register'])->name('demo.user.register');
    Route::get($demo . '/login', [LoginController::class, 'showLoginForm'])->name('demo.login');
    Route::post($demo . '/logout', [LoginController::class, 'logout'])->name('demo.logout');
    Route::post($demo . '/login', [LoginController::class, 'login'])->name('demo.user.login');
    Route::get($demo . '/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('demo.password.request');
    Route::get($demo . '/home', [MainController::class, 'index'])->name('demo.home');
    Route::get($demo . '/', [MainController::class, 'index']);
    Route::get($demo . '/blogs', [MainController::class, 'blog'])->name('demo.blog');
    Route::post($demo . '/showBox', [ProductController::class, 'showBox'])->name('demo.showBox');
    Route::get($demo . '/products/{slug}', [ProductController::class, 'getProduct'])->name('demo.product.single');
    Route::get($demo . '/add-to-cart/{id}/{size?}/{garanty?}', [CartController::class, 'addToCart'])->name('demo.cart.add');
    Route::get($demo . '/add-to-cart2/{product_id}', [Carts2Controller::class, 'add'])->name('demo.cart.add2');
    Route::post($demo . '/remove-item/{id}', [CartController::class, 'removeItem'])->name('demo.cart.remove');
    Route::post($demo . '/remove-item2/{id}', [Carts2Controller::class, 'removeItem'])->name('demo.cart.remove2');
    Route::get($demo . '/cart', [CartController::class, 'getCart'])->name('demo.cart.cart');
    Route::post($demo . '/reset', [UserController::class, 'reset'])->name('demo.user.reset');
    Route::get($demo . '/pages/{slug}', [PageController::class, 'show'])->name('demo.frontend.pages.show');
    Route::get($demo . '/blogs/{slug}', [PostController::class, 'show'])->name('demo.frontend.blogs.show');
    Route::get($demo . '/blogCat/{slug}', [PostController::class, 'blogCat'])->name('demo.frontend.blogs.blogCat');
    Route::get($demo . '/search/{q?}', [ProductController::class, 'serachProducts'])->name('demo.frontend.search');
    Route::get($demo . '/allproduct', [ProductController::class, 'allProduct'])->name('demo.frontend.allproduct');
    Route::get($demo . '/blog', [PostController::class, 'serachPosts'])->name('demo.frontend.blogs.search');
    Route::get($demo . '/comments', [commentController::class, 'reply'])->name('demo.frontend.comments.reply');
    Route::get($demo . '/category/{id}/{page?}', [ProductController::class, 'getProductByCategory'])->name('demo.category.index');
    Route::get($demo . '/mtcomments/{productId}', [MtcommentController::class, 'store'])->name('demo.frontend.mtcomments.store');
    Route::post($demo . '/mtcomments/{productid}', [MtcommentController::class, 'reply'])->name('demo.frontend.mtcomments.reply');
    Route::post($demo . '/productAddGaranty', [ProductController::class, 'addGaranty'])->name('demo.car.garanty');
    Route::get($demo . '/logout', [UserController::class, 'destroy'])->name('logout');;
    Route::middleware('auth:sanctum')->group(function () use ($demo) {
        Route::get($demo . '/addWishlist/{productid}', [WishlistController::class, 'addWishlist'])->name('demo.frontend.addWishlist');
        Route::get($demo . '/removeWishlist/{productid}', [WishlistController::class, 'removeWishlist'])->name('demo.frontend.removeWishlist');
        Route::get($demo . '/comments/{postId}', [commentController::class, 'store'])->name('demo.frontend.comments.store');
        Route::get($demo . '/profile', [UserController::class, 'profile'])->name('demo.user.profile');
        Route::get($demo . '/orders', [OrderController::class, 'index'])->name('demo.profile.orders');
        Route::get($demo . '/orders/lists/{id}', [OrderController::class, 'getOrderLists'])->name('demo.profile.orders.lists');
        Route::post($demo . '/coupon', [CouponController::class, 'addCoupon'])->name('demo.coupon.add');
        Route::post($demo . '/order-verify', [OrderController::class, 'verify'])->name('demo.order.verify');;
        Route::get($demo . '/payment-verify/{id}', [PaymentController::class, 'verify'])->name('demo.payment.verify');
        Route::get($demo . '/addressadd', [UserController::class, 'addressAdd'])->name('demo.address.add');;
        Route::get($demo . '/city/{provinceId}', [UserController::class, 'demo.getAllCities']);
        Route::get( $demo .'/address', [AddressController::class, 'index'])->name('demo.address.index');
        Route::post( $demo .'/address/store', [AddressController::class, 'store'])->name('demo.address.store');
        Route::get($demo . '/edit-profile', [UserController::class, 'storeProfile'])->name('demo.user.editprofile');
        Route::post($demo . '/store-profile/{id}', [UserController::class, 'editProfile'])->name('demo.profile.updateProfile');
        Route::get($demo . '/showPassword', [UserController::class, 'showPassword'])->name('demo.profile.showPassword');
        Route::post($demo . '/editPassword', [UserController::class, 'editPassword'])->name('demo.profile.editPassword');

    });
}
//Route::get('/{id}', [MainController::class, 'services'])->name('services');
Route::get('/home', [MainController::class, 'index'])->name('home');
Route::get('/', [MainController::class, 'index']);

Route::get('/blogs', [MainController::class, 'blog']);
Route::post('showBox', [ProductController::class, 'showBox'])->name('showBox');
Route::get('products/{slug}', [ProductController::class, 'getProduct'])->name('product.single');
Route::get('/add-to-cart/{id}/{size?}/{garanty?}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/add-to-cart2/{product_id}', [Carts2Controller::class, 'add'])->name('cart.add2');
Route::post('/remove-item/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/remove-item2/{id}', [Carts2Controller::class, 'removeItem'])->name('cart.remove2');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.cart');
Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::post('reset', [UserController::class, 'reset'])->name('user.reset');
Route::get('pages/{slug}', [PageController::class, 'show'])->name('frontend.pages.show');
Route::get('blogs/{slug}', [PostController::class, 'show'])->name('frontend.blogs.show');
Route::get('blogCat/{slug}', [PostController::class, 'blogCat'])->name('frontend.blogs.blogCat');
Route::get('search/{q?}', [ProductController::class, 'serachProducts'])->name('frontend.search');
Route::get('/allproduct', [ProductController::class, 'allProduct'])->name('frontend.allproduct');
Route::get('blog', [PostController::class, 'serachPosts'])->name('frontend.blogs.search');
Route::get('comments', [commentController::class, 'reply'])->name('frontend.comments.reply');
Route::get('category/{id}/{page?}', [ProductController::class, 'getProductByCategory'])->name('category.index');
Route::get('mtcomments/{productId}', [MtcommentController::class, 'store'])->name('frontend.mtcomments.store');
Route::post('mtcomments/{productid}', [MtcommentController::class, 'reply'])->name('frontend.mtcomments.reply');
Route::post('productAddGaranty', [ProductController::class, 'addGaranty'])->name('car.garanty');
Route::get('/logout', [UserController::class, 'destroy'])->name('logout');;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('addWishlist/{productid}', [WishlistController::class, 'addWishlist'])->name('frontend.addWishlist');
    Route::get('removeWishlist/{productid}', [WishlistController::class, 'removeWishlist'])->name('frontend.removeWishlist');
    Route::get('comments/{postId}', [commentController::class, 'store'])->name('frontend.comments.store');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/orders', [OrderController::class, 'index'])->name('profile.orders');
    Route::get('/orders/lists/{id}', [OrderController::class, 'getOrderLists'])->name('profile.orders.lists');
    Route::post('/coupon', [CouponController::class, 'addCoupon'])->name('coupon.add');
    Route::post('/order-verify', [OrderController::class, 'verify'])->name('order.verify');;
    Route::get('/payment-verify/{id}', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/addressadd', [UserController::class, 'addressAdd'])->name('address.add');;
    Route::get('/city/{provinceId}', [UserController::class, 'getAllCities']);
    Route::resource('address', AddressController::class);
    Route::get('/edit-profile', [UserController::class, 'storeProfile'])->name('user.editprofile');
    Route::post('/store-profile/{id}', [UserController::class, 'editProfile'])->name('profile.updateProfile');
    Route::get('/showPassword', [UserController::class, 'showPassword'])->name('profile.showPassword');
    Route::post('/editPassword', [UserController::class, 'editPassword'])->name('profile.editPassword');

});

Route::get('/clear/route', [UserController::class, 'clearRoute'])->name('clear.route');
