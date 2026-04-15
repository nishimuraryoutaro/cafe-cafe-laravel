<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/index');
Route::get('/index', [ContactController::class, 'index']);
Route::get('/contact', [ContactController::class, 'contact']);
Route::redirect('/confirm', '/contact');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::redirect('/complete', '/contact');
Route::post('/complete', [ContactController::class, 'complete']);

Route::get('/go-edit', [ContactController::class, 'goEdit']);
Route::get('/edit', [ContactController::class, 'edit']);
Route::post('/edit', [ContactController::class, 'complete']);
Route::get('/delete', [ContactController::class, 'delete']);
Route::post('/back', [ContactController::class, 'back']);
