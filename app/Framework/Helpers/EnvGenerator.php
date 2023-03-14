<?php

namespace App\Framework\Helpers;

class EnvGenerator {
    public function __construct() {
        if (!function_exists('env')) {
            function env($key) {
                $env_array = EnvGenerator::initEnv();
            
                if (isset($env_array[$key])) {
                    return $env_array[$key];
                } else {
                    return null;
                }
            }
        }
    }

    public static function initEnv () {
		$environmentPath = __DIR__ . "/../../../core/Environment.php";
		if(file_exists($environmentPath)){
			require_once $environmentPath;

            return $env_array;
		} else {
            return [];
        }
    }

    public static function load() {
		$environmentPath = __DIR__ . "/../../../core/Environment.php";
		if(file_exists($environmentPath)){
			require_once $environmentPath;

            foreach ($env_array as $key => $value) {
                putenv("$key=$value");
            }
		}
    }

    public static function generate() {
        $envPath = __DIR__ . "/../../../.env";
        $handle = fopen($envPath, "r");

        $envArray = [];
        $envArrayString = "[\n";
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $contents = trim($line);

                if (strlen($contents) >= 3) {
                    if ($contents[0] != "#") {
                        $data = explode("=", $contents);
                        $trimedKey = trim($data[0]);
                        $raw_value = trim($data[1]);
                        $value = $raw_value;
                        if (!empty($value)) {
                            if ($raw_value[0] == '"') {
                                $value = substr($value, 1);
                            }
                            if ($value[strlen($value) -1] == '"') {
                                $value = substr($value, 0, -1);
                            }
                        }
                        $envArray = array_merge($envArray, array(
                            $trimedKey=>$value
                        ));
                    }
                }
            }
        
            fclose($handle);

            $iteration = 0;
            foreach ($envArray as $key => $value) {
                
                if ($iteration != count($envArray)-1) {
                    $envArrayString = $envArrayString . "    \"".$key."\" => \"".$value."\",\n";
                } else {
                    $envArrayString = $envArrayString . "    \"".$key."\" => \"".$value."\"\n];\n";
                }

                $iteration++;
            }

            $envFileContentPath = __DIR__ . "/../../../core/Environment.php";

            $myfile = fopen($envFileContentPath, "w") or die("Unable to open file!");
            fwrite($myfile, "<?php\n\n");
            fwrite($myfile, "\$env_array = ".$envArrayString. "\n\n");
            // fwrite($myfile, "\$env = function (\$key) use(\$env_array) { \n");
            // fwrite($myfile, "    if (in_array(\$key, \$env_array)) {\n");
            // fwrite($myfile, "        return \$env_array[\$key];\n");
            // fwrite($myfile, "    } else {\n");
            // fwrite($myfile, "        return null;\n");
            // fwrite($myfile, "    }\n");
            // fwrite($myfile, "};\n");
            fclose($myfile);

            // print_r($envArray);
        } else {
            echo "\e[0;31;40m Could not validate the environment variables \e[0m\n";
        }
    }
}

new EnvGenerator();

?>