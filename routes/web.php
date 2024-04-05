<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Middleware\AuthenticateMiddle;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;

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
Route::get('dashboard/index', [DashboardController::class, "index"]) ->name('dashboard.index')
->middleware('admin');

Route::group(['prefix'=> 'user'], function(){
    Route::get('index', [UserController::class, "index"]) ->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, "create"]) ->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class, "store"]) ->name('user.store')->middleware('admin');
    Route::get('{id}/edit', [UserController::class, "edit"])->where(['id'=> '[0-9]+']) ->name('user.edit')->middleware('admin');
    Route::post('{id}/update', [UserController::class, "update"])->where(['id'=> '[0-9]+']) ->name('user.update')->middleware('admin');
    Route::get('{id}/delete', [UserController::class, "delete"])->where(['id'=> '[0-9]+']) ->name('user.delete')->middleware('admin');
    Route::delete('{id}/destroy', [UserController::class, "destroy"])->where(['id'=> '[0-9]+']) ->name('user.destroy')->middleware('admin');
});
/*ajax*/
Route::get('ajax/location/getLocation', [LocationController::class, "getLocation"]) ->name('ajax.location.index') ->middleware('admin');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, "changStatus"]) ->name('ajax.dasboard.changeStatus') ->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, "changStatusAll"]) ->name('ajax.dasboard.changeStatusAll') ->middleware('admin');

Route::get('logout', [AuthController::class, "logout"]) ->name('auth.logout');
Route::get('admin', [AuthController::class, "index"]) ->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, "login"]) ->name('auth.login');
