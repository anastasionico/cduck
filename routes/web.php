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
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
if ($options['reset'] ?? true) {
    $this->resetPassword();
}

// Password Confirmation Routes...
if ($options['confirm'] ??
    class_exists($this->prependGroupNamespace('Auth\ConfirmPasswordController'))) {
    $this->confirmPassword();
}

// Email Verification Routes...
if ($options['verify'] ?? false) {
    $this->emailVerification();
}


Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/', function () {
	 		return view('admin/index');
	});


    Route::resource('companies', 'CompaniesController');	    
    Route::resource('employees', 'EmployeesController');	    
});

