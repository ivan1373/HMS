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
    return view('home.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//stranice na koje mogu pristupiti samo prijavljeni korisnici
Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/osobne_postavke', 'AdminController@prikaziOP');
    Route::put('/admin/osobne_postavke/{id}', 'AdminController@izmjenaPodataka');
    Route::get('/admin/izvjestaj', 'AdminController@report')->middleware('super');

    //sobe
    Route::get('/admin/sobe', 'SobeController@index');
    Route::get('/admin/sobe/izmjena/{id}', 'SobeController@edit')->middleware('adminOrSuper');
    Route::put('/admin/sobe/izmjena/{id}', 'SobeController@update')->middleware('adminOrSuper');
    Route::get('/admin/sobe/{id}','SobeController@show');
    Route::get('/admin/sobe/ociscena/{id}','SobeController@clean');
    Route::get('/admin/sobe/brisi/{id}','SobeController@destroy')->middleware('super');
    Route::get('/admin/dodaj_sobu', 'SobeController@create')->middleware('adminOrSuper');
    Route::post('/admin/dodaj_sobu', 'SobeController@store')->middleware('adminOrSuper');

    
    Route::get('/admin/profit', 'AdminController@profit')->middleware('super');

    
    //korisnici
    Route::get('/admin/pregled_korisnika', 'UserController@index')->middleware('adminOrSuper');
    Route::get('/admin/dodaj_radnika', 'UserController@create')->middleware('adminOrSuper');
    Route::post('/admin/dodaj_radnika', 'UserController@store')->middleware('adminOrSuper');
    Route::get('/admin/pregled_korisnika/brisi/{id}','UserController@destroy')->middleware('adminOrSuper');
    Route::get('/admin/pregled_korisnika/uredi_podatke/{id}', 'UserController@edit')->middleware('adminOrSuper');
    Route::put('/admin/pregled_korisnika/uredi_podatke/{id}', 'UserController@update')->middleware('adminOrSuper');
    Route::get('/admin/pregled_korisnika/detalji/{id}','UserController@show')->middleware('adminOrSuper');
    
    
    //napomene
    Route::get('/admin/stvori_napomenu', 'NapomenaController@create');
    Route::post('/admin/stvori_napomenu', 'NapomenaController@store');
    Route::get('/admin/napomene', 'NapomenaController@index');
    Route::get('/admin/napomene/{id}', 'NapomenaController@show');
    Route::put('/admin/napomene/procitana/{id}','NapomenaController@update');
    Route::get('/admin/napomene/izbrisana/{id}','NapomenaController@destroy')->middleware('adminOrSuper');

    //rezervacije
    Route::get('/admin/rezervacije', 'RezervacijaController@index');
    Route::get('/admin/nova_rez', 'RezervacijaController@create');
    Route::post('/admin/nova_rez', 'RezervacijaController@store');
    Route::get('/admin/rezervacije/izmjena_rez/{id}', 'RezervacijaController@edit');
    Route::put('/admin/rezervacije/izmjena_rez/{id}', 'RezervacijaController@update');
    Route::get('/admin/rezervacije/otkaz/{id}', 'RezervacijaController@cancel');
    Route::get('/admin/rezervacije/zavrsi/{id}', 'RezervacijaController@end');
    Route::get('/admin/rezervacije/ukloni/{id}', 'RezervacijaController@destroy')->middleware('adminOrSuper');


    Route::get('logout','AdminController@logout');
});
