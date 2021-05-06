<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\QrgeneratorController;
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

// Auth::routes();

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//qr routes
Route::get('/qrpages/index', [QrgeneratorController::class, 'index'])->name('qrpages.index');

Route::get('/qrpages/queryString', [QrgeneratorController::class, 'queryString']);

Route::get('/qrpages/qrform', [QrgeneratorController::class, 'qrform'])->name('qrpages.qrform')->middleware('auth');

Route::post('/qrpages/store', [QrgeneratorController::class, 'store'])->name('qrpages.store');
Route::post('/qrpages/updateResource', [QrgeneratorController::class, 'updateResource'])->name('qrpages.updateResource');
Route::post('/qrpages/delete', [QrgeneratorController::class, 'delete'])->name('qrpages.delete');

Route::get('/qrpages/qrGenerator', [QrgeneratorController::class, 'qrGenerator'])->name('qrpages.qrGenerator');
