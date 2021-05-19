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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// middleware backoffice

Route::group(['middleware'=>['auth','can:is_backoffice']],function (){

    Route::get('/users', 'UserController@index');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::put('/users/{user}', 'UserController@update');

    Route::get('users/{user}/unban', 'UserController@unban');
    Route::get('users/{user}/ban', 'UserController@ban');

    Route::get('doctors', 'DoctorController@index')->name('doctors.index');

    Route::get('doctors/{user}/approve', 'DoctorController@approve');
    Route::get('doctors/{user}/reject', 'DoctorController@reject');

    Route::get('/reservations','ReservationController@index');

    Route::get('/chart','ChartController@index');
});

// doctor route

Route::get('doctors/create', 'DoctorController@create')->name('doctors.create')->middleware('guest');
Route::post('doctors/create', 'DoctorController@store')->name('doctors.store')->middleware('guest');

// user middleware

Route::group(['middleware'=>['auth','can:is_user']],function (){

    Route::get('specialities','DoctorController@specialities');
    Route::get('/{doctor}/reservations/create','ReservationController@store');
});
// doctor middleware

Route::group(['middleware'=>['auth','can:is_doctor']],function () {

    Route::get('/doctor-reservations','ReservationController@doctorReservations');
    Route::get('/doctor-reservations/accept/{reservation}','ReservationController@accept');
    Route::get('/doctor-reservations/reject/{reservation}','ReservationController@reject');

});

Route::get('read-notification/{notification_id}','NotificationController@read');
