<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
    return view('main');
});
Route::get('/', function()
{
    return View::make('pages.main');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('creatures/review', [CreatureController::class, 'review'])->name('creatures.review');
    Route::get('creatures/admin', [CreatureController::class, 'admin'])->name('creatures.admin');
});

Route::resource('creatures', CreatureController::class);

Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
