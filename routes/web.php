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

Route::get('/test','TestController@index')->name('test.index');



Route::get('/','DashboardController@index')->name('index');

Route::get('/login','LoginController@formLogin')->name('login')->middleware('guest');
Route::post('/login','LoginController@actionLogin')->name('action.login');
Route::get('/logout','DashboardController@logout')->name('logout');

Route::group(['middleware' => 'agent'], function () {
    Route::post('/presences/start','PresenceController@startWork')->name('admin.presences.start');
});

Route::group(['middleware' => 'employee'], function () {
Route::post('/absences/create','DemandeAbsenceController@create')->name('admin.absences.create');
Route::post('/absences/create2','DemandeAbsenceController@create2')->name('admin.absences.create2');


});

Route::group(['middleware' => 'adminoremployee'], function () {

    Route::get('/absences','DemandeAbsenceController@index')->name('admin.absences.index');
    Route::get('/absences/search','DemandesAbsenceController@search')->name('admin.absences.search');
    Route::get('/absences/display','DemandeAbsenceController@display')->name('admin.absences.display');
    Route::post('/absences/update','DemandeAbsenceController@update')->name('admin.absences.update');


    Route::post('/absences/historique/edit','AbsencesjustifieeController@edit')->name('admin.absencesjustifiees.edit');
    Route::post('/absences/historique/update','AbsencesjustifieeController@update')->name('admin.absencesjustifiees.update');
    Route::post('/absences/historique/create','AbsencesjustifieeController@create')->name('admin.absencesjustifiees.create');
    Route::get('/absences/historique','AbsencesjustifieeController@index')->name('admin.absencesjustifiees.index');
    Route::get('/absences/historique/search','AbsencesjustifieeController@search')->name('admin.absencesjustifiees.search');








    Route::get('/vacance','VacanceController@index')->name('admin.vacance.index');

    Route::get('/conge','CongeController@index')->name('admin.conge.index');
    Route::post('/conge/create','CongeController@create')->name('admin.conge.create');
    Route::post('/conge/edit','CongeController@edit')->name('admin.conge.edit');
    Route::post('/conge/update','CongeController@update')->name('admin.conge.update');
    Route::get('/conge/recherche','CongeController@search')->name('admin.conge.search');
    Route::get('/conge/display2','CongeController@display2')->name('admin.conge.display2');

    Route::get('/sanctions','SanctionController@index')->name('admin.sanctions.index');
    Route::post('/sanctions/create','SanctionController@create')->name('admin.sanctions.create');
    Route::post('/sanctions/edit','SanctionController@edit')->name('admin.sanctions.edit');
    Route::post('/sanctions/update','SanctionController@update')->name('admin.sanctions.update');
    Route::get('/sanctions/recherche','SanctionController@search')->name('admin.sanctions.search');
    Route::get('/sanctions/display','SanctionController@display')->name('admin.sanctions.display2');



    
    Route::get('/presences','PresenceController@index')->name('admin.presences.index');
    Route::get('/presences/search','PresenceController@search')->name('admin.presences.search');


    
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