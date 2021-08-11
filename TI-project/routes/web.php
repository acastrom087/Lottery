<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\DrawsController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::resource('manage-draws', DrawsController::class)->middleware(['auth']);

Route::get('draws', [DrawsController::class, 'draws'])->middleware(['auth']);
Route::get('manage-draws/{id}/numbers', [DrawsController::class, 'generateNumber'])->middleware(['auth']);
Route::post('manage-draws/{id}/numbers', [DrawsController::class, 'saveWinner'])->middleware(['auth']);
Route::get('draws/bid/{id}', [BidsController::class, 'bid'])->middleware(['auth']);
Route::post('draws/bid/{id}', [BidsController::class, 'makeBid'])->middleware(['auth']);
Route::get('bids', [BidsController::class, 'createBid'])->middleware(['auth']);;
Route::get('send-email', [MailsController::class, 'sendEmail']);
