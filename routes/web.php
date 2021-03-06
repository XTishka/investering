<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyAvailabiltyController;
use App\Http\Controllers\Admin\RoundController;
use App\Http\Controllers\Admin\StockholderController;
use App\Http\Controllers\Admin\WishController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishController as StockholderWishes;
use App\Http\Controllers\Admin\AdministratorController;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/no_rounds', [StockholderWishes::class, 'noRounds'])->name('no_rounds');
    
    Route::group(['middleware' => 'active_round'], function () {
        Route::controller(StockholderWishes::class)->group(function () {
            Route::get('/', 'index')->name('wishes');
            Route::post('/store_wish', 'store')->name('wish.store');
            Route::delete('/delete_wish/{id}', 'delete')->name('wish.delete');
            Route::get('/get_by_country', 'getPropertiesByCountry')->name('wish.countries');
            Route::get('/get_weeks', 'getWeeksOptionsList')->name('wish.weeks');
            Route::get('/get_wishes_qty', 'getWishesQtyByWeekNumber')->name('wish.wish_qty');
        });
    });
    
    Route::group(['middleware' => 'is_admin'], function () {

        Route::view('/admin', 'admin.layout');
        
        Route::prefix('admin')->group(function () {

            Route::controller(AdministratorController::class)->group(function () {
                Route::get('/administrators', 'index')->name('admin.administrators');
                Route::get('/administrators/create', 'create')->name('admin.administrators.create');
                Route::post('/administrators/store', 'store')->name('admin.administrators.store');
                Route::get('/administrators/show/{administrator}', 'edit')->name('admin.administrators.show');
                Route::get('/administrators/edit/{administrator}', 'edit')->name('admin.administrators.edit');
                Route::put('/administrators/update/{administrator}', 'update')->name('admin.administrators.update');
                Route::delete('/administrators/delete/{administrator}', 'destroy')->name('admin.administrators.delete');
            });

            Route::controller(RoundController::class)->group(function () {
                Route::get('/rounds', 'index')->name('admin.rounds');
                Route::get('/rounds/create', 'create')->name('admin.rounds.create');
                Route::post('/rounds/store', 'store')->name('admin.rounds.store');
                Route::get('/rounds/show/{round}', 'show')->name('admin.rounds.show');
                Route::get('/rounds/edit/{round}', 'edit')->name('admin.rounds.edit');
                Route::put('/rounds/update/{round}', 'update')->name('admin.rounds.update');
                Route::delete('/rounds/delete/{round}', 'destroy')->name('admin.rounds.delete');
            });

            Route::group(['middleware' => 'active_round'], function () {
                Route::controller(DashboardController::class)->group(function () {
                    Route::get('/admin', 'index')->name('admin');
                    Route::get('/dashboard', 'index')->name('admin.dashboard');
                    Route::get('/dashboard/export', 'export')->name('admin.dashboard.export');
                    Route::get('/dashboard/distribute/{round}', 'distribute')->name('admin.dashboard.distribute');
                });

                Route::controller(StockholderController::class)->group(function () {
                    Route::get('/stockholders', 'index')->name('admin.stockholders');
                    Route::get('/stockholders/create', 'create')->name('admin.stockholders.create');
                    Route::post('/stockholders/store', 'store')->name('admin.stockholders.store');
                    Route::get('/stockholders/show/{stockholder}', 'show')->name('admin.stockholders.show');
                    Route::get('/stockholders/edit/{stockholder}', 'edit')->name('admin.stockholders.edit');
                    Route::put('/stockholders/update/{stockholder}', 'update')->name('admin.stockholders.update');
                    Route::delete('/stockholders/delete/{stockholder}', 'destroy')->name('admin.stockholders.delete');
                    Route::post('/stockholders/order', 'order')->name('admin.stockholders.order');
                    Route::post('/stockholders/import', 'import')->name('admin.stockholders.import');
                    Route::get('/stockholders/full-export', 'exportFull')->name('admin.stockholders.full-export');
                    Route::get('/stockholders/round-export', 'exportRound')->name('admin.stockholders.round-export');
                    Route::put('/stockholders/update-available-weeks', 'updatePriorities')->name('admin.stockholders.update-available-weeks');
                });

                Route::controller(PropertyController::class)->group(function () {
                    Route::get('/properties', 'index')->name('admin.properties');
                    Route::get('/properties/create', 'create')->name('admin.properties.create');
                    Route::post('/properties/store', 'store')->name('admin.properties.store');
                    Route::get('/properties/show/{property}', 'show')->name('admin.properties.show');
                    Route::get('/properties/edit/{property}', 'edit')->name('admin.properties.edit');
                    Route::put('/properties/update/{property}', 'update')->name('admin.properties.update');
                    Route::delete('/properties/delete/{property}', 'destroy')->name('admin.properties.delete');
                    Route::post('/properties/import', 'import')->name('admin.properties.import');
                    Route::get('/properties/export', 'export')->name('admin.properties.export');
                });

                Route::controller(StockholderController::class)->group(function () {
                    Route::get('/mail/new-user', 'newUser')->name('admin.mail.new_user');
                });

                Route::controller(WishController::class)->group(function () {
                    Route::get('/wishes', 'index')->name('admin.wishes');
                    Route::get('/wishes/edit/{wish}', 'edit')->name('admin.wishes.edit');
                    Route::get('/wishes/show/{wish}', 'edit')->name('admin.wishes.show');
                    Route::put('/wishes/update/{wish}', 'update')->name('admin.wishes.update');
                    Route::delete('/wishes/delete/{wish}', 'destroy')->name('admin.wishes.delete');
                    Route::get('/wishes/export', 'export')->name('admin.wishes.export');
                });
            });
        });
    });
});
