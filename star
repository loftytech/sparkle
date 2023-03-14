<?php

    if (isset($argc)) {
        // for ($i = 1; $i < $args; $i++) {
        //     echo "Argument #" . $i . " - " . $args[$i] . "\n";
        // }

        if ($argv[1] == "light") {
            include "app/Framework/Helpers/EnvGenerator.php";
            App\Framework\Helpers\EnvGenerator::generate();

            shell_exec("php -S localhost:8000 -t public/");
        }
        if ($argv[1] == "migrate") {
            include "app/Framework/Helpers/EnvGenerator.php";
            App\Framework\Helpers\EnvGenerator::load();
            include "app/Framework/Migrations/Migrator.php";
        }
    }
    
?>