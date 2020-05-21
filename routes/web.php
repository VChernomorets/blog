<?php

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

use App\User;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index')->name('posts');
        Route::get('/create', 'PostController@create')->name('post.create');
        Route::get('/{id}', 'PostController@show')->name('post.show');
        Route::get('{id}/edit', 'PostController@edit')->name('post.edit');
        Route::post('/', 'PostController@store')->name('post.store');
        Route::post('/comment', 'CommentController@store')->name('comment.store');
        Route::post('/like/{id}', 'LikePostController@store')->name('post.like');
        Route::put('{id}', 'PostController@update')->name('post.update');
    });
    Route::post('/comment/like/{id}', 'LikeCommentController@store')->name('comment.like');

    Route::get('/user/{id}', function ($id) {
        $user = User::findOrFail($id);
        return view('users.posts', ['posts' => $user->post]);
    })->name('user.posts');
});

Route::get('/', function () {
    return redirect()->route('posts');
})->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Auth::routes();

