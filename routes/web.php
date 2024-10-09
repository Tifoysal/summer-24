<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;



//for frontend

Route::group(['middleware' => 'changeLangMiddleware'], function () {

    Route::get('/', [FrontendHomeController::class, 'home'])->name('home');

    Route::get('/change/lang/{lang_name}', [FrontendHomeController::class, 'changeLang'])->name('change.lang');
    Route::get('/all-products', [FrontendProductController::class, 'allProduct'])->name('frontend.products');
    Route::post('/registration', [FrontendCustomerController::class, 'registration'])->name('customer.registration');

    Route::post('/do-login', [FrontendCustomerController::class, 'customerLogin'])->name('customer.login');

    Route::get('/show-product/{productId}', [FrontendProductController::class, 'showProduct'])->name('show.product');


    Route::get('/add-to-cart/{productId}', [OrderController::class, 'addToCart'])->name('add.to.cart');

    Route::get('/view-cart', [OrderController::class, 'viewCart'])->name('view.cart');

    Route::post('/update-cart/{pid}', [OrderController::class, 'updateCart'])->name('update.cart');

    Route::get('/clear-cart', [OrderController::class, 'clearCart'])->name('cart.clear');

    Route::get('/cart/item/delete/{id}', [OrderController::class, 'cartItemDelete'])->name('cart.item.delete');

    Route::get('/search', [FrontendProductController::class, 'search'])->name('search');

    Route::get('/products-under-category/{category_id}', [FrontendHomeController::class, 'productsUnderCategory'])->name('products.under.category');

    Route::group(['middleware' => 'customer_auth'], function () {
        Route::get('/logout', [FrontendCustomerController::class, 'logout'])->name('customer.logout');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');

        Route::get('/view-profile', [FrontendCustomerController::class, 'viewProfile'])->name('view.profile');
        Route::get('/order-cancel/{order_id}', [FrontendCustomerController::class, 'cancelOrder'])->name('cancel.order');

        Route::get('/view-invoice/{order_id}', [OrderController::class, 'viewInvoice'])->name('view.invoice');
        Route::post('/success', [PaymentController::class, 'success']);

        Route::get('/add-to-wishlist/{product_id}', [WishListController::class, 'addToWishList'])->name('add.wishlist');
    });
});

// for admin panel

Route::group(['prefix' => 'admin'], function () {


    Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('login');

    Route::post('/do-login', [AuthenticationController::class, 'doLogin'])->name('do.login');


    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', [HomeController::class, 'home'])->name('dashboard');

        Route::post('/set-alert-stock', [ProductController::class, 'setAlertStock'])->name('set.alert.stock');

        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

        Route::get('/contact-us', [ContactController::class, 'contact'])->name('contact');

        Route::get('/order-list', [OrderController::class, 'orderList'])->name('admin.orders');

        Route::get('/report', [OrderController::class, 'report'])->name('admin.report');


        Route::get('/product-list', [ProductController::class, 'productList'])->name('product.list');

        Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');

        Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/delete/{p_id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/product/view/{p_id}', [ProductController::class, 'viewProduct'])->name('product.view');
        Route::get('/product/edit/{sojibId}', [ProductController::class, 'edit'])->name('product.edit');

        Route::post('/product/update/{paglaID}', [ProductController::class, 'update'])->name('product.update');

        Route::get('/customer-list', [CustomerController::class, 'customerList'])->name('customer.list');

        Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/category-delete/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');

        Route::get('/category-form', [CategoryController::class, 'form'])->name('category.form');

        Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/business-settings', [HomeController::class, 'settings'])->name('admin.business.settings');
        Route::post('/business-settings', [HomeController::class, 'settingSubmit'])->name('settings.submit');
        Route::post('/rugi-settings', [HomeController::class, 'rugi'])->name('settings.rugi');
    });
});
