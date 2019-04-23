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
    $viewType = \Setting::get('viewType');
    $page = \App\Page::find($page);
    $pageType = $page->pageable_type;
    return view('welcome', compact('page', 'pageType', 'viewType'));
});

Route::prefix('cms')->group(function() {
    Route::get('/','AdminController@index')->name('cms.index');

    Route::get('effects','EffectController@index')->name('cms.effects.index');
    Route::post('effects/upload','EffectController@upload')->name('cms.effects.upload');

    Route::get('dancers','DancerController@index')->name('cms.dancers.index');
    Route::get('create/dancer','DancerController@edit')->name('cms.dancers.create');
    Route::get('edit/dancer/{dancer}','DancerController@edit')->name('cms.dancers.edit');
    Route::get('delete/dancer/{dancer}','DancerController@delete')->name('cms.dancers.delete');
    Route::post('save/dancer/{dancer?}','DancerController@save')->name('cms.dancers.save');

    Route::post('/page/select','PageController@select');
    Route::post('/page/dancer/create','PageController@createDancerPage');

    Route::get('images','ImageController@index')->name('cms.images.index');
    Route::get('create/image','ImageController@edit')->name('cms.images.create');
    Route::get('edit/image/{image}','ImageController@edit')->name('cms.images.edit');
    Route::get('delete/image/{image}','ImageController@delete')->name('cms.images.delete');
    Route::post('save/image/{image?}','ImageController@save')->name('cms.images.save');
});
Route::get('pool','PoolController@index')->name('pool.index');
