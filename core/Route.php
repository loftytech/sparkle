<?php

use App\Framework\Utilities\Request;


class Route {

	private static function validateRoute($route, $type, 	array | callable ...$functions) {
		/*
		 *	Get requested url / endpoint ending '/' if present
		 */
		$raw_req_url = str_replace("/mypaywave", "", explode('?', $_SERVER['REQUEST_URI'])[0]);
		(substr($raw_req_url, -1) == '/') && $raw_req_url = substr($raw_req_url, 0, -1);
		
		
		/*
		 *	Get set url / endpoints end remove ending '/' if present
		 */
		$raw_set_url = $route;
		(substr($raw_set_url, -1) == '/') && $raw_set_url = substr($raw_set_url, 0, -1);


		/*
		 *	Convert requested url and set endpoints to arrays and get their length
		 */
		$req_url_with_query = explode('?', $raw_req_url);
		$req_url_arr = explode('/', substr($req_url_with_query[0], 1));
		$req_url_len = count($req_url_arr);

		$set_url_arr = explode('/', substr($raw_set_url, 1));
		$set_url_len = count($set_url_arr);


		$url_params = array(); // requested url parameters
		$set_params = array(); // set endpoints parameters

		$req_url_str = ""; // requested url string without parameters
		$set_url_str = ""; // set endpoints string without parameters

		$att_params = array(); // assigned parameters to values


		/*
		 *	Extrating set parameter values and 
		 *	creating new set endpoint string and
		 *	new requested url string without their parameters
		 */

		if ($req_url_len == $set_url_len) {
			for ($i=0; $i < count($set_url_arr); $i++) { 
				if ($set_url_arr[$i] && $set_url_arr[$i][0] == ':') {
					array_push($set_params, array(
						'data'=> substr($set_url_arr[$i], 1),
						'index' => $i
					));

					if ($req_url_arr[$i] != '') {
						array_push($url_params, array(
							'data'=> $req_url_arr[$i],
							'index' => $i
						));
					}

				} else {
					$set_url_str = $set_url_str . $set_url_arr[$i];

					if ($req_url_len == $set_url_len) {
						$req_url_str = $req_url_str . $req_url_arr[$i];
					}
				}
			}

			if (count($url_params) == count($set_params)) {
				for ($i=0; $i < count($set_params); $i++) { 
					$att_params = array_merge($att_params, array(
						$set_params[$i]['data'] => $req_url_arr[$set_params[$i]['index']]
					));
				}
			}
		}

		if ($req_url_len == $set_url_len && strtolower($req_url_str) == strtolower($set_url_str) && count($url_params) == count($set_params) && strtolower($_SERVER['REQUEST_METHOD']) == strtolower($type)) {
			$request = new Request(params: $att_params, query: $_GET, body: array_merge(json_decode(file_get_contents('php://input')) ?? [], $_POST));
			foreach($functions as $key => $function) {

				if (is_callable($function)) {
					$returnedData = $function($request);
					if ($returnedData != null) {
						$request = $returnedData;
					} else {
						exit;
					}
				} else if (is_array($function)) {
					[$class, $method] = $function;

					if (class_exists($class)) {
						$class = new $class();

						if (method_exists($class, $method)) {
							$returnedData = call_user_func_array([$class, $method], [$request]);
							if ($returnedData != null) {
								$request = $returnedData;
							} else {
								exit;
							}
						}
					}
				}
			}
			exit;
			
		} else if ($route == "/404") {
			$lastMethod = end($functions);
			$lastMethod();
			exit;
		} else {
			// echo "Invalid route";
		}
	}

	public static function set($route, $type, array | callable ...$functions ) {
		self::validateRoute($route, $type, ...$functions);
	}

	public static function get($route, array | callable ...$functions ) {
			self::validateRoute($route, "GET", ...$functions);
	}

	public static function post($route, array | callable ...$functions ) {
			self::validateRoute($route, "POST", ...$functions);
	}
	public static function patch($route, array | callable ...$functions ) {
			self::validateRoute($route, "PATCH", ...$functions);
	}
	public static function put($route, array | callable ...$functions ) {
			self::validateRoute($route, "PUT", ...$functions);
	}
	public static function delete($route, array | callable ...$functions ) {
			self::validateRoute($route, "DELETE", ...$functions);
	}
}

?>