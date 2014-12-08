<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/test', function() {	
// });



Route::Get('/', array('as' => 'home', 'uses' => 'UploaderController@index'));
Route::post('/upload', array('as' => 'upload', 'uses' => 'UploaderController@upload'));
Route::get('/remote/{file?}', array('as' => 'upload.remote', 'uses' => 'UploaderController@remote'));
Route::get('/pages/remote/{file}', array('as' => '', 'uses' => 'UploaderController@remote')); //retro compatiblity

Route::get('thecakeisalie/{tag?}', array('as' => 'thecakeisalie', 'uses' => 'ImageBoardController@index'));
Route::get('thecakeisalierandom', array('as' => 'thecakeisalierandom', 'uses' => 'ImageBoardController@random'));
Route::get('thecakeisalieslideshow', array('as' => 'thecakeisalieslideshow', 'uses' => 'AjaxController@randomImage'));

//admin

Route::group(array('prefix' => 'admin'), function() {
	Route::get('/', array('as' => 'admin.index', 'uses' => 'AuthController@index'));
	Route::post('/', array('as' => 'admin.login', 'uses' => 'AuthController@login'));
	Route::get('/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@logout'));
	Route::get('/remove/{img_id}', array('as' => 'image.remove', 'uses' => 'ImageBoardController@remove'));
});


Route::get('{slug}', array('as' => 'image.show', 'uses' => 'ImageBoardController@show'));
Route::get('images/view/{slug}','ImageBoardController@show'); //retro compatiblity

//ajax
Route::post('ajax/storeCommentTags', array('as' => 'store.comment.tags', 'uses' => 'AjaxController@storeCommentTags'));
Route::post('ajax/getTags', array('as' => 'tags.getlist', 'uses' => 'AjaxController@getTags'));
Route::post('ajax/getImageByTerm', array('as' => 'tags.search', 'uses' => 'AjaxController@getImageByTerm'));
Route::get('ajax/getTagList', array('as' => 'tags.list', 'uses' => 'AjaxController@getTagList'));