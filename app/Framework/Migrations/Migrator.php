<?php
namespace App\Framework\Migrations;

include __DIR__ . "/../../../vendor/autoload.php";
class Migrator {
    public function __construct() {
        $dir = new \DirectoryIterator(__DIR__ . "/../../Models");

        $migrationList = [];

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $raw_file_name = $fileinfo->getFilename();
                $file_name = str_replace(".php", "", $raw_file_name);

                array_push($migrationList, [
                    $file_name,
                    ["App\Models\\"."$file_name", 'table']
                ]);
            }
        }

        foreach($migrationList as $migration) {
            if (is_callable($migration[1])) {
                $migration[1]();
                // echo "\033[32m ".$migration[0]." migrated successfully \033[0m\n";
            }
        }


    }
}

new Migrator();

?>