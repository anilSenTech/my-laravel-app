<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController; // Ensure you import the correct controller

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

// Route to the index method of the ChatController
Route::get('/', [ChatController::class, 'index'])->name('user-login');

// Route to the broadcastChat method of the ChatController
Route::post('/broadcast', [ChatController::class, 'broadcastChat'])->name('broadcast.chat');
Route::get('/chat', [ChatController::class, 'notFound'])->name('no.chat');
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');