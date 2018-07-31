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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('profile.edit.info', Auth::user()->email_uri);
    }
    return view('pages.login.index');
})->name('home');

Route::get('{emailUri}/edit-info', 'ProfileController@getEditInfo')->name('profile.edit.info');
Route::post('/{emailUri}/image', 'ProfileController@postStoreImage')->name('profile.store.image');
Route::post('/{emailUri}/info', 'ProfileController@postStoreInfo')->name('profile.store.info');
Route::post('/login', 'LoginController@postLogin')->name('post.login');
Route::get('/logout', function () {
    Auth::logout();
    session()->forget('user');
    return redirect()->route('home');
})->name('logout');
