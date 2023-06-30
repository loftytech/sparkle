<?php
namespace App\Framework\Utilities;

class Log {
    public static function success(string $text) {
        echo "\033[32m ".$text." \033[0m\n";
    }
    public static function error(string $text) {
        echo "\e[0;31;40m ".$text." \e[0m\n";
    }
    public static function warning(string $text) {
        echo "\e[1;33;40m ".$text." \e[0m\n";
    }
    public static function neutral(string $text) {
        echo "\e[0;35;35m ".$text." \e[0m\n";
    }
}

?>