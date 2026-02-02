<?php

use App\Http\Controllers\PostMOMController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostMOMController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostMOMController::class, 'show'])->name('posts.show');
