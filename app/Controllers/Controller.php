<?php
namespace App\Controllers;
use App\View;

class Controller {
	private static $auth_token;
	public static function auth() {
		header('Content-Type: application/json');
		$req_data = file_get_contents('php://input');
		$req_data = json_decode($req_data);


		$req_token = explode(' ', apache_request_headers()['Authorization'])[1];
		self::$auth_token = $req_token;

		if (!Login::isLoggedIn($req_token)) {
			echo json_encode(array(
				'message'=>'Unauthorized user',
				'status'=>2
			));
			exit;
		}
	}
	
	public static function getAuthToken() {
		return self::$auth_token;
	}

	public static function setAuthToken(string $token) {
		self::$auth_token = $token;
	}


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