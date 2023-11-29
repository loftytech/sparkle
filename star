<?php

    require_once "core/env_loader.php";

    if (isset($argc)) {
        // for ($i = 1; $i < $args; $i++) {
        //     echo "Argument #" . $i . " - " . $args[$i] . "\n";
        // }

        if ($argv[1] == "light") {
            require_once __DIR__ . "/app/Framework/Helpers/EnvGenerator.php";
            App\Framework\Helpers\EnvGenerator::generate();

            shell_exec("php -S localhost:".env("APP_PORT", 8000)." -t public/");
        }
        if ($argv[1] == "migrate") {
            require_once __DIR__ . "/app/Framework/Helpers/EnvGenerator.php";
            App\Framework\Helpers\EnvGenerator::load();
            include "app/Framework/Migrations/Migrator.php";
        }
        if ($argv[1] == "configure") {
            require_once __DIR__ . "/app/Framework/Helpers/EnvGenerator.php";
            App\Framework\Helpers\EnvGenerator::generate();
            
            echo "\033[32m App configurations loaded successfully \033[0m\n";
        }
    }
    
?>