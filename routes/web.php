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
    Route::post('/admin/osobne_postavke/{id}', 'AdminController@izmjenaPodataka');
    Route::get('/admin/izvjestaj', 'AdminController@report');

    //sobe
    Route::get('/admin/sobe', 'SobeController@index');
    Route::get('/admin/sobe/izmjena/{id}', 'SobeController@edit');
    Route::post('/admin/sobe/izmjena/{id}', 'SobeController@update');
    Route::get('/admin/sobe/{id}','SobeController@show');
    Route::get('/admin/sobe/ociscena/{id}','SobeController@clean');
    Route::get('/admin/sobe/brisi/{id}','SobeController@destroy');
    Route::get('/admin/dodaj_sobu', 'SobeController@create');
    Route::post('/admin/dodaj_sobu', 'SobeController@store');

    
    Route::get('/admin/profit', 'AdminController@profit');

    
    //korisnici
    Route::get('/admin/pregled_korisnika', 'UserController@index');
    Route::get('/admin/dodaj_radnika', 'AdminController@dodajKorisnika');
    Route::post('/admin/dodaj_radnika', 'UserController@store');
    Route::get('/admin/pregled_korisnika/brisi/{id}','UserController@destroy');
    Route::get('/admin/pregled_korisnika/uredi_podatke/{id}', 'UserController@edit');
    Route::post('/admin/pregled_korisnika/uredi_podatke/{id}', 'UserController@update');
    Route::get('/admin/pregled_korisnika/detalji/{id}','UserController@show');
    
    
    //napomene
    Route::get('/admin/stvori_napomenu', 'NapomenaController@create');
    Route::post('/admin/stvori_napomenu', 'NapomenaController@store');
    Route::get('/admin/napomene', 'NapomenaController@index');
    Route::get('/admin/napomene/{id}', 'NapomenaController@show');
    Route::get('/admin/napomene/procitana/{id}','NapomenaController@update');
    Route::get('/admin/napomene/izbrisana/{id}','NapomenaController@destroy');

    //rezervacije
    Route::get('/admin/rezervacije', 'RezervacijaController@index');
    Route::get('/admin/nova_rez', 'RezervacijaController@create');
    Route::post('/admin/nova_rez', 'RezervacijaController@store');
    Route::get('/admin/rezervacije/izmjena_rez/{id}', 'RezervacijaController@edit');
    Route::post('/admin/rezervacije/izmjena_rez/{id}', 'RezervacijaController@update');
    Route::get('/admin/rezervacije/otkaz/{id}', 'RezervacijaController@cancel');
    Route::get('/admin/rezervacije/zavrsi/{id}', 'RezervacijaController@end');
    Route::get('/admin/rezervacije/ukloni/{id}', 'RezervacijaController@destroy');


    Route::get('logout','AdminController@logout');
});
