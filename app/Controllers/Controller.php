<?php
namespace App\Controllers;
use App\View;

class Controller {
	public static function createView($viewName, $params = null) {
		$params = (object) $params;

		$data = [
			'site_title'=>env('APP_NAME'),
		];
		View::useLayout($viewName, $data);
	}

	public static function useTemplate($viewName, $params = null) {
		$params = (object) $params;

		$data = [
			'site_title'=>env('APP_NAME'),
		];
		View::make($viewName, $data);
	}



	public static function testCreateView($viewName, $params = null) {
		$params = (object) $params;

		$data = [
			'site_title'=>env('APP_NAME'),
		];
		View::makeTest($viewName, $data);
	}
}

?>