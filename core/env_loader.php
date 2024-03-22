<?php

require_once __DIR__ . "/../app/Framework/Helpers/EnvGenerator.php";
function env(string $key, string $default = null) {
    $envData = App\Framework\Helpers\EnvGenerator::initEnv();

    if (getenv($key)) {
        return getenv($key);
    } else if (isset($envData[$key])) {
        return $envData[$key];
    } else {
        return $default;
    }
}

function yieldStyles(string $path) {
    $texts = file_get_contents($path);
    echo $texts;
}

?>