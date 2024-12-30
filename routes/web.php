<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/book/{id}',[HomeController::class,'detail'])->name('book.detail');
Route::post('/save-book-review',[HomeController::class,'saveReview'])->name('book.saveReview');

Route::group(['prefix' => 'account'], function () {
    // Guest Routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'register'])->name('account.register');
        Route::post('/register', [AccountController::class, 'prosessRegister'])->name('account.processRegister');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/login', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });

        
        Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
       
        Route::group(['middleware' =>'check-admin'],function(){
            Route::get('/books', [BookController::class, 'index'])->name('books.index');
            Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
            Route::post('/books', [BookController::class, 'store'])->name('books.store');
            Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
            Route::post('/books/edit/{id}', [BookController::class, 'update'])->name('books.update');
            Route::delete('/books', [BookController::class, 'destroy'])->name('books.destroy');
    
            Route::get('/reviews', [ReviewController::class, 'index'])->name('account.reviews');
            // Route::any('/delete-review', [ReviewController::class, 'deleteReview'])->name('account.reviews.deleteReview');
            Route::post('/delete-review/{id}', [ReviewController::class, 'deleteReview'])->name('account.reviews.deleteReview');
            Route::get('/my-reviews', [AccountController::class, 'myReviews'])->name('account.myReviews');
            Route::get('/delete-reviews/{id}', [AccountController::class, 'deleteReview'])->name('account.deleteReview');
    
        });
        

    });
});