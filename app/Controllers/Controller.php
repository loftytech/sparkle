<?php
namespace App\Controllers;
use App\View;

class Controller {
	public static function CreateView($viewName, $params = null) {
		$params = (object) $params;

		$data = [
			'site_title'=>getenv('APP_NAME'),
		];
		View::useLayput($viewName, $data);
	}

	public static function useTemplate($viewName, $params = null) {
		$params = (object) $params;

		$data = [
			'site_title'=>getenv('APP_NAME'),
		];
		View::make($viewName, $data);
	}
}

?>