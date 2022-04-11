<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/login','LoginController@formLogin')->name('login')->middleware('guest');
Route::post('/login','LoginController@actionLogin')->name('action.login');
Route::get('/logout','AdminController@logout')->name('logout');

Route::get('/employee','EmployeeController@index')->name('employee.index');
Route::get('/agent','AgentController@index')->name('agent.index');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/','AdminController@index')->name('admin.index');

    Route::get('/conge','CongeController@index')->name('admin.conge.index');
    Route::post('/conge/action','CongeController@action')->name('admin.conge.action');


    Route::get('/users','UserController@index')->name('admin.users.index');
    Route::get('/users/{id}','UserController@employee')->name('admin.users.employee');
    Route::post('/users/create','UserController@store')->name('admin.users.create');
    Route::post('/users/edit','UserController@edit')->name('admin.users.edit');
    Route::post('/users/update','UserController@update')->name('admin.users.update');
    Route::post('/users/delete','UserController@destroy')->name('admin.users.delete');

    Route::get('/attendances','AttendanceController@index')->name('admin.attendances.index');
    Route::post('/attendances/start','AttendanceController@startWork')->name('admin.attendances.start');
    Route::post('/attendances/finish','AttendanceController@finishWork')->name('admin.attendances.finish');

    Route::get('/paiement/historique','PaiementController@historique')->name('admin.paiement.historique');
    Route::get('/paiement','PaiementController@index')->name('admin.paiement.index');
    Route::post('/paiement/store','PaiementController@store')->name('admin.paiement.store');
    Route::get('/paiement/historique/display','PaiementController@display')->name('admin.paiement.display');
    Route::get('/paiement/historique/display2','PaiementController@display2')->name('admin.paiement.display2');
    Route::get('/paiement/search','PaiementController@search')->name('admin.paiement.search');
    Route::get('/paiement/historique/search','PaiementController@search2')->name('admin.paiement.search2');

});