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

Route::get('/', 'HomeController@index');
//Route::get('/{org_id}' , 'IndocController@showOrganization')->name('showOrganization');
//Route::get('/{indoc_id}' , 'IndocController@show')->name('showIndoc');

Route::get('/create', function(){
    return view('settings.organization.create');
});

Route::post('/create', 'OrganizationController@store'

/*Route::post('/create', function (){
    \App\Organization::create([
        'name' => request('name')
        ]);
    return redirect('/create');*/
/*    $organization = new \App\Organization();
    $organization->name = request('name');
    $organization->save();*/
//}
);
