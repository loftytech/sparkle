<?php

use App\Controllers\AuthController as Auth;
use App\Framework\Utilities\Response;

/*
*	Auth Route
*/

Route::post('/v1/signup', [App\Controllers\AuthController::class, 'signup']);
Route::get('/v1/profile', [App\Middlewares\Authentication::class, 'check'], [App\Controllers\AuthController::class, 'getProfile']);
Route::post('/v1/signin', function($request) {
	Auth::login($request);
});



/*
*	404 Route
*/
Route::set('/404', 'GET', function() {
	Response::send([
		'status'=>0,
		'message'=>'not found',
	], 404);
});


?>