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

// Route::get('/contact_us', function(){
// 	return view('contact_us');
// });

// Route::get('/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('home');
// });


// Route::get('/', function () {
//     return view('home');
// });

Route::get('/','HomeController@index');
// Route::get('/about', function () {
//     return view('about');
// });


//Route::view('/contact_us','contact_us',['name'=>'Taylor']);
Route::resource('showProfile', 'ShowProfile');
Route::get('contact_us','ContactUsController@index');
Route::get('/product/details/{product_id}', 'HomeController@productDetails');
Route::post('/product/submitRating', 'HomeController@submitRating');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Cart Items
Route::post('/add-to-cart','CartController@addToCart');
Route::post('/update-cart', 'CartController@updateCart');
Route::get('/mycart','CartController@mycart');
Route::any('/cartItemDelete/{temp_order_row_id}', 'CartController@cartItemDelete');
Route::any('/cartItemDeleteAll', 'CartController@cartItemDeleteAll');

// Checkout
Route::get('/checkoutPage', 'CartController@checkout');
Route::post('/confirm-order', 'CartController@confirmOrder');

//Register....
Route::get('/user-registration', 'Auth\CommonController@showRegistrationForm')->name('user.registration');
Route::post('/user-registration', 'Auth\CommonController@register')->name('user.registration.submit');
//log in 
Route::post('/log-in', 'Auth\CommonController@login')->name('gaust.login');
Route::get('users/logout','Auth\LoginController@userlogout')->name('user.logout');

Route::get('/thankyou', 'CartController@thankyou');

//Middleware Admin
Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {           
    Route::get('/admin', 'LoginController@login');
    Route::post('/postAdminLogin', 'LoginController@postAdminLogin'); 
    Route::get('/admin/logout', 'LoginController@logout');        
    Route::get('/admin/dashboard', 'DashboardController@index');
});
