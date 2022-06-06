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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/edit-organization/{org_id}' , 'IndocController@showOrganization')->name('showOrganization');
Route::get('/show-indoc/{indoc_id}' , 'IndocController@show')->name('showIndoc');
Route::get('/edit-indoc/{indoc_id}' , 'IndocController@edit')->name('editIndoc');
Route::post('/edit-indoc/{indoc_id}' , 'IndocController@update')->name('updateIndoc');
Route::get('/add-indoc' , 'IndocController@create')->name('createIndoc');
Route::post('/add-indoc' , 'IndocController@store')->name('storeIndoc');

Route::get('/create', function(){
    return view('settings.organization.create');
});

Route::post('/create', 'OrganizationController@store');

/*Route::post('/create', function (){
    \App\Organization::create([
        'name' => request('name')
        ]);
    return redirect('/create');*/
/*    $organization = new \App\Organization();
    $organization->name = request('name');
    $organization->save();*/
//}

