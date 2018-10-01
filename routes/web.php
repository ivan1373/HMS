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

    Route::group(['prefix' => 'admin'], function(){

    Route::get('dashboard', 'AdminController@index');
    Route::get('osobne_postavke', 'AdminController@prikaziOP');
    Route::put('osobne_postavke/{id}', 'AdminController@izmjenaPodataka');
    Route::get('izvjestaj', 'AdminController@report')->middleware('super');
    Route::get('profit', 'AdminController@profit')->middleware('super');

    //sobe
    Route::get('sobe', 'SobeController@index');
    Route::get('sobe/izmjena/{id}', 'SobeController@edit')->middleware('adminOrSuper');
    Route::put('sobe/izmjena/{id}', 'SobeController@update')->middleware('adminOrSuper');
    Route::get('sobe/{id}','SobeController@show');
    Route::get('sobe/ociscena/{id}','SobeController@clean');
    Route::delete('sobe/brisi/{id}','SobeController@destroy')->middleware('super');
    Route::get('dodaj_sobu', 'SobeController@create')->middleware('adminOrSuper');
    Route::post('dodaj_sobu', 'SobeController@store')->middleware('adminOrSuper');

    
    //korisnici
    Route::get('pregled_korisnika', 'UserController@index')->middleware('adminOrSuper');
    Route::get('dodaj_radnika', 'UserController@create')->middleware('adminOrSuper');
    Route::post('dodaj_radnika', 'UserController@store')->middleware('adminOrSuper');
    Route::delete('pregled_korisnika/brisi/{id}','UserController@destroy')->middleware('adminOrSuper');
    Route::get('pregled_korisnika/uredi_podatke/{id}', 'UserController@edit')->middleware('adminOrSuper');
    Route::put('pregled_korisnika/uredi_podatke/{id}', 'UserController@update')->middleware('adminOrSuper');
    Route::get('pregled_korisnika/detalji/{id}','UserController@show')->middleware('adminOrSuper');
    
    
    //napomene
    Route::get('stvori_napomenu', 'NapomenaController@create');
    Route::post('stvori_napomenu', 'NapomenaController@store');
    Route::get('napomene', 'NapomenaController@index');
    Route::get('napomene/{id}', 'NapomenaController@show');
    Route::put('napomene/procitana/{id}','NapomenaController@update');
    Route::delete('napomene/izbrisana/{id}','NapomenaController@destroy')->middleware('adminOrSuper');


    //rezervacije
    Route::get('rezervacije', 'RezervacijaController@index');
    Route::get('nova_rez', 'RezervacijaController@create');
    Route::post('nova_rez', 'RezervacijaController@store');
    Route::get('rezervacije/izmjena_rez/{id}', 'RezervacijaController@edit');
    Route::put('rezervacije/izmjena_rez/{id}', 'RezervacijaController@update');
    Route::get('rezervacije/otkaz/{id}', 'RezervacijaController@cancel');
    Route::get('rezervacije/zavrsi/{id}', 'RezervacijaController@end');
    Route::delete('rezervacije/ukloni/{id}', 'RezervacijaController@destroy')->middleware('adminOrSuper');

    });

    //odjava iz sustava
    Route::get('logout','AdminController@logout');

});
