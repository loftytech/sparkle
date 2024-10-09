<?php
namespace App\Framework\Utilities;

class Response {
    public static function send(array $data, int $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data, JSON_NUMERIC_CHECK);
        exit;
    }
}

?>