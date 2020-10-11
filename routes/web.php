<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

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


Route::group(['prefix'=>'dashboard', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/', [RequestController::class, 'index'])->name('dashboard');
    Route::post('/create', [RequestController::class, 'store'])->name('create');
    Route::post('/status', [RequestController::class, 'changeRequestStatus']);
});
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
