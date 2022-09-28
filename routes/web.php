<?php

use App\Http\Controllers\RoomsController;
use App\Http\Controllers\VotesController;
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
    Route::post('/rooms/{room}/finish', [RoomsController::class, 'finish'])->name('rooms.finish');
    Route::post('/rooms/{room}/votes', [VotesController::class, 'store'])->name('rooms.votes');
    Route::delete('/rooms/{room}/votes', [VotesController::class, 'reset']);
    Route::delete('/rooms/{room}/boot', [RoomsController::class, 'boot'])->name('rooms.boot');
});

require __DIR__ . '/auth.php';
