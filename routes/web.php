<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::redirect('/', '/login');

Route::get('/home', 'HomeController@getHomeView');

Route::post('/send', 'CRUDController@create');

Route::post('/delete/{historyId}', 'CRUDController@delete');

Route::post('/delete_rough/{historyId}', 'CRUDController@delete_rough');

Route::post('/search', 'HomeController@search');

Route::get('/mypage', 'HomeController@getMypageView');

Route::get('/update', 'HomeController@getUpdateView');

Route::post('/update', 'CRUDController@update');

Route::post('/update_mail', 'MailChangeController@mailChange');

Route::post('/delete', 'CRUDController@deleteAccount');
