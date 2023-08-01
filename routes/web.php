<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Friend requests
    Route::post('/send-friend-request/{friendId}', [FriendController::class, 'sendFriendRequest'])->name('send.friend.request');
    Route::post('/accept-friend-request/{friendId}', [FriendController::class, 'acceptFriendRequest'])->name('accept.friend.request');
    Route::post('/reject-friend-request/{friendId}', [FriendController::class, 'rejectFriendRequest'])->name('reject.friend.request');

    // Friend list
    Route::get('/profile/friends', [ProfileController::class, 'showFriendList'])->name('profile.friends');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
});

Route::post('/wishlist/add', 'WishlistController@addToWishlist')->name('wishlist.add');

Route::get('/filter/gender', 'FilterController@filterByGender')->name('filter.gender');


Route::get('/search', 'SearchController@search')->name('search');



Route::get('/', [HomeController::class, 'index'])->name('home');
