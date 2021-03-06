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
Route::post('/' , 'IndocController@store')->name('storeIndoc');


      /*организации*/
Route::get('/organizations', 'OrganizationController@index');
Route::get('/organizations/create', 'OrganizationController@create');
Route::post('/organizations', 'OrganizationController@store');
Route::get('/organizations/{org_id}', 'OrganizationController@show');
Route::get('/organizations/{org_id}/edit', 'OrganizationController@edit')->name('editOrganization');
Route::post('/organizations/{org_id}', 'OrganizationController@update');
Route::delete('/organizations/{org_id}', 'OrganizationController@destroy')->name('destroyOrganization');

/*Route::post('/create', function (){
    \App\Organization::create([
        'name' => request('name')
        ]);
    return redirect('/create');*/
/*    $organization = new \App\Organization();
    $organization->name = request('name');
    $organization->save();*/
//}

