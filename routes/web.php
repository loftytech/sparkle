<?php

use App\Controllers\Controller;
use App\View;

Route::get('/', function() {
	Controller::createView("Home");
});


Route::get('/test', function() {
	View::useExperimentView("Test");
});

// Route::get('/404', function() {
// 	// Index::CreateView("404");
// });


?>