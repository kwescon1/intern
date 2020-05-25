<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// user routes
Route::post('login', 'Api\User\LoginController@login');
Route::post('register', 'Api\User\RegisterController@register');
Route::post('activate', 'Api\User\RegisterController@activatAccount');
Route::post('update', 'Api\User\DetailController@updateDetails');
Route::post('forgot', 'Api\User\ForgotPasswordController@forgotPassword');
Route::post('verifycode','Api\User\ForgotPasswordController@verifyCode');
Route::post('set', 'Api\User\ForgotPasswordController@setPassword');

Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'Api\User\DetailController@details');
});

//advert routes
Route::get('advert','Api\Advert\AdvertismentController@advert');
Route::get('exclusivead','Api\Advert\ExclusiveController@exclusive');

//bookmark
Route::post('addbookmark','Api\Advert\BookmarkController@bookmarkAd');
Route::post('mybookmark','Api\Advert\BookmarkController@bookmark');
Route::post('delbookmark','Api\Advert\BookmarkController@deleteBookmark');

// comment
Route::post('comment','Api\Advert\CommentController@comment');
Route::post('uncomment','Api\Advert\CommentController@delComment');
Route::post('verify', 'Api\Advert\CommentController@verifyComment');
Route::post('editcomment', 'Api\Advert\CommentController@editComment');
Route::post('retrievecomment', 'Api\Advert\CommentController@retrieveComment');

//like advert
Route::post('like','Api\Advert\LikeAdController@like');
Route::post('dislike','Api\Advert\LikeAdController@dislike');
Route::post('retrievelike','Api\Advert\LikeAdController@retrieveLike');

//short stories
Route::get('story','Api\Story\StoryController@story');

