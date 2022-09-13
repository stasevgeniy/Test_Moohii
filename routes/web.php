<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('MainRoute');

Route::post('/add', [MainController::class, 'add'])->name('AddRoute');

Route::get('/updateMarkers', [MainController::class, 'updateMarkers'])->name('UpdateMarkersRoute');
