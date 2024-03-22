<?php

    use App\Framework\Helpers\EnvGenerator;

    require __DIR__ . '/vendor/autoload.php';
    require_once "core/env_loader.php";

    if (isset($argc)) {
        if ($argv[1] == "light") {
            EnvGenerator::generate();
            shell_exec("php -S localhost:".env("APP_PORT", 8000)." -t public/");
        }
        if ($argv[1] == "migrate") {
            EnvGenerator::load();
            include "app/Framework/Migrations/Migrator.php";
        }
        if ($argv[1] == "configure") {
            EnvGenerator::generate();
            
            echo "\033[32m App configurations loaded successfully \033[0m\n";
        }
    }
    
?>