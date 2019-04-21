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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $page = \Setting::get('page');
    $page = \App\Page::find($page);
    return view('welcome', compact('page'));
});

Route::prefix('cms')->group(function() {
    Route::get('/','AdminController@index')->name('cms.index');

    Route::get('effects','EffectsController@index')->name('cms.effects.index');
    Route::post('effects/upload','EffectsController@upload')->name('cms.effects.upload');

    Route::get('dancers','DancersController@index')->name('cms.dancers.index');
    Route::post('dancers/upload','DancersController@upload')->name('cms.dancers.upload');
    Route::get('edit/dancer/{dancer}','DancersController@edit')->name('cms.dancers.edit');
    Route::get('delete/dancer/{dancer}','DancersController@delete')->name('cms.dancers.delete');
    Route::post('save/dancer/{dancer?}','DancersController@save')->name('cms.dancers.save');

    Route::post('/selectPage','PageController@select');
});
Route::get('pool','PoolController@index')->name('pool.index');