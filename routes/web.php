<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;



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

Route::middleware('auth')->group(function () {
     // ? 追加（検索画面）
  Route::get('/training/search/input', [SearchController::class, 'create'])->name('search.input');
  // ? 追加（検索処理）
  Route::get('/training/search/result', [SearchController::class, 'index'])->name('search.result');
  
  Route::get('/training/timeline', [TrainingController::class, 'timeline'])->name('training.timeline');

  Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');

  Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
  Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');

  Route::post('training/{training}/favorites', [FavoriteController::class, 'store'])->name('favorites');
  Route::post('training/{training}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

  Route::get('/training/mypage', [TrainingController::class, 'mydata'])->name('training.mypage');
  Route::resource('training', TrainingController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
