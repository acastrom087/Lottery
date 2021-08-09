<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::resource('manage-draws', LotteryController::class)->middleware(['auth']);

Route::get('draws', [LotteryController::class, 'draws'])->middleware(['auth']);
Route::get('draws/bid/{id}', [LotteryController::class, 'bid'])->middleware(['auth']);
Route::post('draws/bid/{id}', [LotteryController::class, 'makeBid'])->middleware(['auth']);
Route::get('manage-draws/{id}/numbers', [LotteryController::class, 'generateNumber'])->middleware(['auth']);
Route::post('manage-draws/{id}/numbers', [LotteryController::class, 'saveWinner'])->middleware(['auth']);
Route::get('bids', [BidController::class, 'indexTwo'])->middleware(['auth']);;
Route::get('send-email', [MailController::class, 'sendEmail']);
