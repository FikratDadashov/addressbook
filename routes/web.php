<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', [AdminController::class, 'index']);
Route::get('/address', [AdminController::class, 'create']);
Route::post('/address', [AdminController::class, 'store']);
Route::get('/address/{id}', [AdminController::class, 'edit']);
Route::put('/address/{id}', [AdminController::class, 'update']);
Route::delete('/address/{id}', [AdminController::class, 'destroy']);
