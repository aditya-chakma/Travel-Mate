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

use App\Http\Controllers\UserInformationController;
use Illuminate\Foundation\Auth\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/location', 'HomeController@location')->name('location');
Route::post('/location', 'HomeController@addlocation')->name('add.location');

Route::get('/company', 'HomeController@company')->name('company');
Route::post('/company', 'HomeController@addcompany')->name('add.company');

Route::get('/service', 'HomeController@service')->name('service');
Route::post('/service', 'HomeController@addservice')->name('add.service');
Route::post('/update_service', 'HomeController@updateservice')->name('update.service');

Route::get('/service_update_form', 'HomeController@updateserviceform');
Route::post('/service_update_form', 'HomeController@updateservicetodatabase')->name('update.service.form');

Route::post('/approve_service', 'HomeController@approveservice');

Route::post('/delete', 'HomeController@deleteservice');

Route::get('/home', 'UserInformationController@dataTable');
Route::get('/verification', 'UserInformationController@verificationPage');
Route::post('/verification', 'UserInformationController@verificationRequestSent');
Route::get('/verification_request_list', 'UserInformationController@verification_request_list');
Route::post('/verify', 'UserInformationController@verify');

Route::get('/rating', 'ratingController@rating');
Route::post('/rating', 'ratingController@castRating')->name('cast.rating');

Route::post('/search_city', 'searchController@searchcity');
Route::post('/search_district', 'searchController@searchdistrict');
Route::post('/search_location', 'searchController@searchlocation');
Route::get('/search_result', 'searchController@searchresult');
Route::get('/search_result_district', 'searchController@searchresultdistrict');
Route::get('/search_result_location', 'searchController@searchresultlocation');

Route::get('/see_review', 'searchController@seereview');

Route::get('/profile', 'UserInformationController@profile');
Route::get('/update_profile', 'UserInformationController@update_profile_view');

Route::post('/update_profile', 'UserInformationController@update_profile')->name('update.profile');
Route::post('/approve', 'UserInformationController@approve');


Route::get('/book_now', 'bookingController@booknow');
Route::post('/book_now', 'bookingController@booksubmit');

Route::get('/booked_service', 'bookingController@bookedservice');
Route::get('/cancel_booking', 'bookingController@cancelbooking');

Route::get('/approve_book', 'bookingController@approvebook');

Route::get('/report', 'HomeController@report');

Route::post('/filter_now', 'searchController@filterNow');
Route::get('/filteredSearchResult', 'searchController@filterBlade');
