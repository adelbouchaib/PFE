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




Route::get('/','DashboardController@index')->name('index');

Route::get('/login','LoginController@formLogin')->name('login')->middleware('guest');
Route::post('/login','LoginController@actionLogin')->name('action.login');
Route::get('/logout','DashboardController@logout')->name('logout');

Route::group(['middleware' => 'agent'], function () {
    Route::post('/attendances/start','AttendanceController@startWork')->name('admin.attendances.start');
});

Route::group(['middleware' => 'employee'], function () {
Route::post('/absences/create','AbsenceController@create')->name('admin.absences.create');
});

Route::group(['middleware' => 'adminoremployee'], function () {

    Route::get('/absences','AbsenceController@index')->name('admin.absences.index');
    Route::get('/absences/search','AbsenceController@search')->name('admin.absences.search');
    Route::get('/absences/display2','AbsenceController@display2')->name('admin.absences.display2');
    Route::post('/absences/update','AbsenceController@update')->name('admin.absences.update');
    Route::get('/absences/historique','AbsenceController@absence')->name('admin.absences.absence');



    Route::get('/vacance','VacanceController@index')->name('admin.vacance.index');

    Route::get('/conge','CongeController@index')->name('admin.conge.index');
    Route::post('/conge/create','CongeController@create')->name('admin.conge.create');
    Route::post('/conge/edit','CongeController@edit')->name('admin.conge.edit');
    Route::post('/conge/update','CongeController@update')->name('admin.conge.update');
    Route::get('/conge/recherche','CongeController@search')->name('admin.conge.search');
    Route::get('/conge/display2','CongeController@display2')->name('admin.conge.display2');



    
    Route::get('/attendances','AttendanceController@index')->name('admin.attendances.index');
    Route::get('/attendances/search','AttendanceController@search')->name('admin.attendances.search');


    
    Route::get('/projet','ProjetController@index')->name('admin.projet.index');
    Route::get('/projet/historique','ProjetController@historique')->name('admin.projet.historique');
});


Route::group(['middleware' => 'admin'], function () {


    Route::post('/vacance/action','VacanceController@action')->name('admin.vacance.action');

    Route::get('/users','UserController@index')->name('admin.users.index');
    Route::get('/users/{id}','UserController@employee')->name('admin.users.employee');
    Route::post('/users/create','UserController@store')->name('admin.users.create');
    Route::post('/users/edit','UserController@edit')->name('admin.users.edit');
    Route::post('/users/update','UserController@update')->name('admin.users.update');
    Route::post('/users/delete','UserController@destroy')->name('admin.users.delete');
    Route::post('/users/directions','UserController@direction')->name('admin.users.direction');
    Route::get('/employes/search','UserController@search')->name('admin.users.search');
 

    Route::post('/projet/create','ProjetController@create')->name('admin.projet.create');
    Route::post('/projet/task','ProjetController@task')->name('admin.projet.task');
    Route::post('/projet/edit','ProjetController@edit')->name('admin.projet.edit');
    Route::post('/projet/task/create','TaskController@create')->name('admin.task.create');
    Route::post('/projet/task/delete','TaskController@destroy')->name('admin.task.destroy');

    Route::get('/directions','StructureController@direction')->name('admin.structure.direction');
    Route::post('/directions/store','StructureController@store')->name('admin.structure.store');
    Route::get('/branches','StructureController@branche')->name('admin.structure.branche');
    Route::post('/branches/save','StructureController@save')->name('admin.structure.save');






});