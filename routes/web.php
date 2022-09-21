<?php

use App\Http\Controllers\RoomsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $rooms = current_user()->rooms;
    return view('dashboard', compact('rooms'));
})->middleware(['auth'])->name('dashboard');

Route::get('/rooms', [RoomsController::class, 'create'])->name('rooms.new');
Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms');

Route::middleware(['auth'])->group(function () {
    Route::get('/rooms/{room}', [RoomsController::class, 'show'])->name('rooms.show');
});

require __DIR__ . '/auth.php';
