<?php
namespace App\Framework\Utilities;

use Exception;

class HttpRequest {
    public static $request_url;
    public static $headers;

    public static function withHeaders(array $headers) {
        self::$headers = $headers;
        return __CLASS__;
    }

    private static function getHeaders() {
        return array_map(function($value, $key) {
            return $key.': '.$value;
        }, array_values(self::$headers), array_keys(self::$headers));
    }

    public static function post(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "POST");
        if (self::$headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, self::getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }


    public static function patch(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "PATCH");
        if (self::$headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, self::getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }


    public static function put(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "PUT");
        if (self::$headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, self::getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }



    public static function delete(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "DELETE");
        if (self::$headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, self::getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }



    public static function get(string $url) {
        $init_request = curl_init($url);

        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "GET");
        if (self::$headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, self::getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }
}