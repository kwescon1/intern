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
    return view('welcome');
});

Route::get('addcompany','Web\AddCompanyController@create');
Route::post('addcompany','Web\AddCompanyController@store');


Route::get('addadvert','Web\AddAdvertController@create');
Route::post('addadvert', 'Web\AddAdvertController@store');

Route::get('addstory', 'Web\AddStoryController@create');
Route::post('addstory','Web\AddStoryController@store');
