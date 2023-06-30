<?php
namespace App\Framework\Utilities;

use Exception;

class HttpRequest {
    public static $request_url;
    public $headers;

    public static function withHeaders(array $headers) : self {
        $httpRequest =  new HttpRequest();
        $httpRequest->headers = $headers;
        return $httpRequest;
    }

    private function getHeaders() {
        return array_map(function($value, $key) {
            return $key.': '.$value;
        }, array_values($this->headers), array_keys($this->headers));
    }

    public function post(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "POST");
        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }


    public function patch(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "PATCH");
        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }


    public function put(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "PUT");
        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }



    public function delete(string $url, array $data = []) {
        $init_request = curl_init($url);

        $payload = json_encode($data);

        curl_setopt( $init_request, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "DELETE");
        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }



    public function get(string $url) {
        $init_request = curl_init($url);

        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, "GET");
        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }
        curl_setopt( $init_request, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($init_request);
        $err = curl_error($init_request);
        curl_close($init_request);
        $status_code = curl_getinfo($init_request, CURLINFO_HTTP_CODE);

        $response_data = json_decode($result);

        if ($err) {
            throw new Exception($err);
        } else {
            return (object) array('data'=>$response_data, 'status_code' => $status_code);
        }
    }
}