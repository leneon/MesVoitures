<?php

use App\Models\Feedback;
use App\Models\Voiture;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    dd(Voiture::all());
    return view('welcome');
})->name('');

Route::group([],function(){

    Route::get('/dashboard','MainController@dashboard')->name('dashboard');

    Route::post('/log','MainController@login')->name('login');

    Route::get('/profil/{id}','MainController@profil')->name('profil');
    Route::get('/mon_profil/{id}','MainController@mon_profil')->name('mon_profil');
    Route::post('/profil','MainController@update_profil')->name('update_profil');

    Route::get('/password','MainController@password')->name('password');
    Route::post('/password','UserController@update_password')->name('update_password');



});

Route::group([],function(){

    Route::resource('locations', LocationController::class);
    Route::resource('voitures', VoitureController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('utilisateurs', UserController::class);
    Route::resource('user', UserController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('paiements', PaiementController::class);
    Route::resource('feedbacks', FeedbackController::class);


    Route::put('retirer/{user}','UserController@retirer')->name('retirer');
    Route::put('publier/{feedback}','FeedbackController@publier')->name('publier');
    Route::put('retouner/{reservation}','ReservationController@retourner')->name('retouner');
    Route::get('locations','ReservationController@locations')->name('locations');
    Route::get('paiement/{reservation}','PaiementController@paiement')->name('paiements.paiement');
    Route::put('approuver/{reservation}','ReservationController@approuver')->name('reservations.approuver');
    Route::put('annuler/{reservation}','ReservationController@annuler')->name('reservations.annuler');
    Route::get('form_reservation/{voiture}','ReservationController@form_reservation')->name('form_reservation');
    Route::get('new_reservation','ReservationController@new_reservation')->name('new_reservation');
    Route::get('new_user','UserController@new_user')->name('new_user');
    Route::post('new_user','UserController@add_user')->name('add_user');
    Route::get('/clients','UserController@clients')->name('clients');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
