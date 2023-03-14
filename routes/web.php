<?php
use App\Controllers\Index;
use App\Controllers\AuthController as Auth;
use App\Controllers\SigninController;
use App\Controllers\SignOut;



Route::get('/', function() {
	// Index::CreateView("Home");
});

/*
*	Auth Route
*/

Route::get('/signup', function($params) {
	Auth::useTemplate('Signup', $params);
});
Route::get('/login', function($params) {
	Auth::useTemplate('Login', $params);
});
Route::get('/logout', function() {
	Auth::useTemplate("Logout");
});


/*
*	404 Route
*/
Route::get('/404', function() {
	// Index::CreateView("404");
});


?>