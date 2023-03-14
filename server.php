<?php
	date_default_timezone_set("Africa/Lagos");

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, OPTIONS");         
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    require_once "app/Framework/Helpers/EnvGenerator.php";
    function env(string $key) {
        $envData = App\Framework\Helpers\EnvGenerator::initEnv();

        if (getenv($key)) {
            return $key;
        } else if (isset($envData[$key])) {
            return $envData[$key];
        } else {
            return null;
        }
    }

	require __DIR__ . '/vendor/autoload.php';

    putenv("JAMES=felix");

	require_once 'core/Route.php';
	require_once 'routes/web.php';
	require_once 'routes/api.php';
?>