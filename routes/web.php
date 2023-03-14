<?php

use App\Controllers\Controller;

Route::get('/', function() {
	Controller::createView("Home");
});


// Route::get('/404', function() {
// 	// Index::CreateView("404");
// });


?>