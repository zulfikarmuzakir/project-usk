<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopupController;
use Illuminate\Cache\RedisTaggedCache;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/', [AdminController::class, 'get_users'])->name('admin.users.index');
                Route::post('/', [AdminController::class, 'store_user'])->name('admin.users.store');
                Route::patch('/{id}', [AdminController::class, 'update_user'])->name('admin.users.update');
                Route::get('/{id}', [AdminController::class, 'delete_user'])->name('admin.users.delete');
            });
        });
    });

    Route::middleware(['bank'])->group(function () {
        Route::prefix('bank')->group(function () {
            Route::get('/', [BankController::class, 'index'])->name('bank.index');
        });
    });

    Route::middleware(['canteen'])->group(function () {
        Route::prefix('canteen')->group(function () {
            Route::get('/items', [CanteenController::class, 'items'])->name('canteen.items');
            Route::post('/items', [CanteenController::class, 'store'])->name('canteen.items.store');
            Route::put('/items/{id}', [CanteenController::class, 'update'])->name('canteen.items.update');
            Route::delete('/items/{id}', [CanteenController::class, 'delete'])->name('canteen.items.delete');
            Route::get('/orders', [CanteenController::class, 'orders'])->name('canteen.orders');
            Route::put('/orders/approve/{id}', [CanteenController::class, 'approve_order'])->name('canteen.order.approve');
            Route::put('/orders/reject/{id}', [CanteenController::class, 'reject_order'])->name('canteen.order.reject');
            Route::get("/history", [CanteenController::class, 'history'])->name("canteen.history");
            Route::get('/wallet', [CanteenController::class, 'wallet'])->name('canteen.wallet');
        });
    });

    Route::middleware(['user'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/wallet', [UserController::class, 'wallet'])->name('user.wallet');
            Route::get('/shop', [UserController::class, 'shop'])->name('user.shop');
            Route::post('/topup/request', [UserController::class, 'topup_request'])->name('user.topup.request');
            Route::post('/cart', [UserController::class, 'addToCart'])->name('user.addToCart');
            Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
            Route::post('/checkout', [UserController::class, 'checkout'])->name('user.checkout');
            Route::get('/history', [UserController::class, 'history'])->name('user.history');
        });
    });

    Route::middleware(['cantopup'])->group(function () {
        Route::prefix('topup')->group(function () {
            Route::get('/', [TopupController::class, 'create'])->name('topup.create');
            Route::post('/', [TopupController::class, 'topup'])->name('topup.store');
            Route::get('/history', [TopupController::class, 'history'])->name('topup.history');
            Route::get('/request', [TopupController::class, 'topup_request'])->name('topup.request');
            Route::put('/request/approve/{id}', [TopupController::class, 'topup_approve'])->name('topup.approve');
            Route::put('/request/reject/{id}', [TopupController::class, 'topup_reject'])->name('topup.reject');

        });
    });

   
});





