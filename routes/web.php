<?php

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

// Homepage
Route::get('/', function () {
    return view('home');
});
Route::redirect('/', '/polls');

// Polls
Route::get('polls', [App\Http\Controllers\PollController::class, 'index'])->name('polls.index');
Route::get('polls/create', [App\Http\Controllers\PollController::class, 'create'])->name('polls.create')->middleware('auth');
Route::post('polls/store', [App\Http\Controllers\PollController::class, 'store'])->name('polls.store');
Route::get('polls/{poll}', [App\Http\Controllers\PollController::class, 'show'])->name('polls.show');
Route::get('polls/{poll}/edit', [App\Http\Controllers\PollController::class, 'edit'])->name('polls.edit');
Route::put('polls/{poll}/update', [App\Http\Controllers\PollController::class, 'update'])->name('polls.update');
Route::delete('polls/{poll}', [App\Http\Controllers\PollController::class, 'destroy'])->name('polls.destroy');

// Votes
Route::delete('votes/{vote}', [App\Http\Controllers\VoteController::class, 'destroy'])->name('votes.destroy');

// Comments
Route::delete('comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

// Members
Route::get('members', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('members/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

// Notifications
Route::get('notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index')->middleware('auth');

// Messages
Route::get('messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index')->middleware('auth');
Route::post('messages/store', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
Route::get('messages/{user}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show')->middleware('auth');
Route::put('messages/{message}/update', [App\Http\Controllers\MessageController::class, 'update'])->name('messages.update');
Route::delete('messages/{message}', [App\Http\Controllers\MessageController::class, 'destroy'])->name('messages.destroy');

// Pages
Route::get('/terms', function () {
    return view('pages.terms');
});
