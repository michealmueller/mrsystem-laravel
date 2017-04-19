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

Route::get('/', [
    'middleware'=> 'auth',
    'uses'      => 'MembersController@index'
    ])->name('home');

Route::post('/', 'MembersController@index');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/members', [
        'middleware'=>'auth',
        'uses'=>'MembersImportController@index'
    ])->name('import');

Route::post('/members', 'MembersImportController@uploadFile');

Route::get('/randomselection', 'MembersController@Randomindex')->name('random');
Route::post('/randomselection', 'MembersController@GetRandom');
Route::get('/exportselected', 'MembersController@Exportmembers')->name('export');

Route::group(['prefix'=>'members', 'middleware'=>'auth'], function(){
    Route::get('selected', 'MembersController@ViewSelected')->name('selected');
    Route::get('edit/{id}', 'MembersController@EditMember');
    Route::post('edit/{id}', 'MembersController@UpdateMember');
    Route::get('edit/remove/{id}', 'MembersController@RemoveMember');
});

Route::get('/home', 'HomeController@index');
