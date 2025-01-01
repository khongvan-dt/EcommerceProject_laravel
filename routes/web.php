<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductMediaController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ReviewBlogController;
use App\Http\Controllers\ReviewProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotgetPasswordController;

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

 
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/fotgotPassword', [FotgetPasswordController::class, 'fotgetPassword'])->name('fotgetPassword');
Route::post('/fotgotPassword', [FotgetPasswordController::class, 'checkFotgotPassword'])->name('checkFotgetPassword');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'checkRegister'])->name('checkRegister');

//Shared routes
Route::get('/', [DashboardUserController::class, 'index'])->name('dashboard');

Route::get('/shop', [DashboardUserController::class, 'shop'])->name('shop');
Route::get('/contact', [DashboardUserController::class, 'contact'])->name('contact');
Route::get('/about', [DashboardUserController::class, 'about'])->name('about');
Route::get('/blog', [DashboardUserController::class, 'blog'])->name('blog');
Route::get('/product/{id}', [DashboardUserController::class, 'product'])->name('product');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart']); 
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/delete/{productId}', [CartController::class, 'deleteCart'])->name('cart.delete');
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::post('/cart/apply-voucher', [CartController::class, 'applyVoucher'])->name('cart.apply-voucher');
Route::post('/cart/remove-voucher', [CartController::class, 'removeVoucher'])->name('cart.remove-voucher');

Route::middleware('auth')->group(function () {
    Route::get('/ListOrder', [DashboardUserController::class, 'listOrder'])->name('viewOrder');
    Route::get('/ListOrder/{orderId}', [DashboardUserController::class, 'listOrderDetail'])->name('viewOrderDetail');
    Route::post('/review/{orderId}', [DashboardUserController::class, 'store'])->name('review.store'); // Thêm route này

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


//Route for admin
Route::group(['middleware' => ['role:ADMIN'], 'prefix' => 'admin'], function () {
    // web.php
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Route for Attributes
    Route::get('/attributes/{id}', [AttributeController::class, 'index'])->name('admin.attributes.index');
    Route::get('/attributes/create/{id}', [AttributeController::class, 'create'])->name('admin.attributes.create');
    Route::post('/attributes/store/{id}', [AttributeController::class, 'store'])->name('admin.attributes.store');
    Route::get('/attributes/edit/{id}/{productId}', [AttributeController::class, 'edit'])->name('admin.attributes.edit');
    Route::put('attributes/update/{id}/{productId}', [AttributeController::class, 'update'])->name('admin.attributes.update');
    Route::delete('/attributes/{id}/{productId}', [AttributeController::class, 'destroy'])->name('admin.attributes.destroy');

    // Route for AttributeValues
    Route::get('/attributeValues/{id}', [AttributeValueController::class, 'index'])->name('admin.attributeValues.index');
    Route::get('/attributeValues/create/{id}', [AttributeValueController::class, 'create'])->name('admin.attributeValues.create');
    Route::post('/attributeValues/store', [AttributeValueController::class, 'store'])->name('admin.attributeValues.store');
    Route::get('/attributeValues/edit/{id}/{attributeId}', [AttributeValueController::class, 'edit'])->name('admin.attributeValues.edit');
    Route::put('attributeValues/update/{id}', [AttributeValueController::class, 'update'])->name('admin.attributeValues.update');
    Route::delete('/attributeValues/{id}/{attributeId}', [AttributeValueController::class, 'destroy'])->name('admin.attributeValues.destroy');

    // Route for Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('blogs/update/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

    // Route for Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('brands/update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

    // Route for categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Route for discounts
    Route::get('/discounts', [DiscountController::class, 'index'])->name('admin.discounts.index');
    Route::get('/discounts/create', [DiscountController::class, 'create'])->name('admin.discounts.create');
    Route::post('/discounts/store', [DiscountController::class, 'store'])->name('admin.discounts.store');
    Route::get('/discounts/edit/{id}', [DiscountController::class, 'edit'])->name('admin.discounts.edit');
    Route::put('discounts/update/{id}', [DiscountController::class, 'update'])->name('admin.discounts.update');
    Route::delete('/discounts/{id}', [DiscountController::class, 'destroy'])->name('admin.discounts.destroy');

    // Route for ProductMedia
    Route::get('/media/{id}', [ProductMediaController::class, 'index'])->name('admin.media.index');
    Route::get('/media/create/{id}', [ProductMediaController::class, 'create'])->name('admin.media.create');
    Route::post('/media/store/{id}', [ProductMediaController::class, 'store'])->name('admin.media.store');
    Route::get('/media/edit/{id}/{productId}', [ProductMediaController::class, 'edit'])->name('admin.media.edit');
    Route::put('media/update/{id}/{productId}', [ProductMediaController::class, 'update'])->name('admin.media.update');
    Route::delete('/media/{id}/{productId}', [ProductMediaController::class, 'destroy'])->name('admin.media.destroy');

    Route::prefix('products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('index');
        Route::get('/create', [ProductsController::class, 'create'])->name('create');
        Route::post('/store', [ProductsController::class, 'store'])->name('store'); 
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::post('/store/{id}', [ProductsController::class, 'store'])->name('store.update'); 
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('destroy');
    });

    // Route for ProductType
    Route::get('/productTypes', [ProductTypeController::class, 'index'])->name('admin.productTypes.index');
    Route::get('/productTypes/create', [ProductTypeController::class, 'create'])->name('admin.productTypes.create');
    Route::post('/productTypes/store', [ProductTypeController::class, 'store'])->name('admin.productTypes.store');
    Route::get('/productTypes/edit/{id}', [ProductTypeController::class, 'edit'])->name('admin.productTypes.edit');
    Route::put('productTypes/update/{id}', [ProductTypeController::class, 'update'])->name('admin.productTypes.update');
    Route::delete('/productTypes/{id}', [ProductTypeController::class, 'destroy'])->name('admin.productTypes.destroy');

    // Route for ReviewBlogs
    Route::get('/reviewBlogs', [ReviewBlogController::class, 'index'])->name('admin.reviewBlogs.index');
    Route::get('/reviewBlogs/create', [ReviewBlogController::class, 'create'])->name('admin.reviewBlogs.create');
    Route::post('/reviewBlogs/store', [ReviewBlogController::class, 'store'])->name('admin.reviewBlogs.store');
    Route::get('/reviewBlogs/edit/{id}', [ReviewBlogController::class, 'edit'])->name('admin.reviewBlogs.edit');
    Route::put('reviewBlogs/update/{id}', [ReviewBlogController::class, 'update'])->name('admin.reviewBlogs.update');
    Route::delete('/reviewBlogs/{id}', [ReviewBlogController::class, 'destroy'])->name('admin.reviewBlogs.destroy');


    // Route for ReviewProducts
    Route::get('/reviewProducts', [ReviewProductController::class, 'index'])->name('admin.reviewProducts.index');
    Route::get('/reviewProducts/create', [ReviewProductController::class, 'create'])->name('admin.reviewProducts.create');
    Route::post('/reviewProducts/store', [ReviewProductController::class, 'store'])->name('admin.reviewProducts.store');
    Route::get('/reviewProducts/edit/{id}', [ReviewProductController::class, 'edit'])->name('admin.reviewProducts.edit');
    Route::put('reviewProducts/update/{id}', [ReviewProductController::class, 'update'])->name('admin.reviewProducts.update');
    Route::delete('/reviewProducts/{id}', [ReviewProductController::class, 'destroy'])->name('admin.reviewProducts.destroy');
    // Route for Type
    Route::get('/types', [TypeController::class, 'index'])->name('admin.types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('admin.types.create');
    Route::post('/types/store', [TypeController::class, 'store'])->name('admin.types.store');
    Route::get('/types/edit/{id}', [TypeController::class, 'edit'])->name('admin.types.edit');
    Route::put('types/update/{id}', [TypeController::class, 'update'])->name('admin.types.update');
    Route::delete('/types/{id}', [TypeController::class, 'destroy'])->name('admin.types.destroy');


    // Route for Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Route for Vouchers
    Route::get('/vouchers', [VoucherController::class, 'index'])->name('admin.vouchers.index');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('admin.vouchers.create');
    Route::post('/vouchers/store', [VoucherController::class, 'store'])->name('admin.vouchers.store');
    Route::get('/vouchers/edit/{id}', [VoucherController::class, 'edit'])->name('admin.vouchers.edit');
    Route::put('vouchers/update/{id}', [VoucherController::class, 'update'])->name('admin.vouchers.update');
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');

    // Route for Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/edit/{id}', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Route for orderDetails
    Route::get('/orderDetails/{id}', [OrderController::class, 'show'])->name('admin.orderDetails.index');
});


