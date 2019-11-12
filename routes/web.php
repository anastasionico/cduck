<?php
use App\Company;
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
	$companies = Company::all();
    return view('welcome')->with('companies', $companies);
});

Route::get('/admin', function () {
    return view('admin/index');
});

// Authentication Routes without registration
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resetPassword();
Route::confirmPassword();
Route::emailVerification();



Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/', function () {
	 		return view('admin/index');
	});


    Route::resource('companies', 'CompaniesController');	    
    Route::resource('employees', 'EmployeesController');	    
});

