<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminController::class, 'get_users'])->name('admin.users.index');
            Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/{id}', [UserController::class, 'delete_user'])->name('admin.users.delete');
        });
    });

    Route::prefix('bank')->group(function () {
        Route::get('/', [App\Http\Controllers\BankController::class, 'index'])->name('bank.index');
        Route::get('/topup', [BankController::class, 'topup'])->name('bank.topup');
        Route::post('/topup', [BankController::class, 'new_topup'])->name('bank.topup.store');
    });

    Route::prefix('canteen')->group(function () {
        Route::get('/items', [CanteenController::class, 'items'])->name('canteen.items');
        Route::post('/items', [CanteenController::class, 'store'])->name('canteen.items.store');
    });

    Route::prefix('user')->group(function () {
        Route::get('/wallet', [UserController::class, 'wallet'])->name('user.wallet');
    });

});




