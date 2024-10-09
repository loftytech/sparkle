<?php
namespace App\Framework\Utilities;

use Exception;

class HttpRequest {
    public $request_url;
    public $headers;
    public $basic_auth;

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

    public function withBasicAuth(array $basic_auth) : self {
        $this->basic_auth = (object) $basic_auth;
        return $this;
    }

    private function resolveQueryParams(array $params) {
        $iteration = 0;
        $rsolvedQuery = "";
        forEach ($params as $key => $value) {
          if ($iteration == 0) {
            $key_encoded = urlencode($key);
            $value_encoded = urlencode($value);
            $rsolvedQuery = "?$key_encoded=$value_encoded";
          } else {
            $key_encoded = urlencode($key);
            $value_encoded = urlencode($value);
            $rsolvedQuery = $rsolvedQuery . "&$key_encoded=$value_encoded";
          }
          $iteration = $iteration + 1;
        }

        return $rsolvedQuery;
      }


    public function resolveRequest($type = "GET", array $data = [], $query = []) {
        $query = $this->resolveQueryParams($query);


        $use_url_post_fields = false;

        $headers = (object) $this->headers;

        if (isset($headers?->{'Content-Type'}) && $headers?->{'Content-Type'} == "application/x-www-form-urlencoded") {
            $query = substr($query, 1);
            $use_url_post_fields = true;
        }


        $init_request = curl_init( !$use_url_post_fields ? $this->request_url .$query : $this->request_url);

        if ($type != "GET") {
            $payload = json_encode($data);

        // Response::send(["choke" => $use_url_post_fields ? $query : $payload]);
            curl_setopt( $init_request, CURLOPT_POSTFIELDS, $use_url_post_fields ? $query : $payload);
        }

        curl_setopt($init_request, CURLOPT_CUSTOMREQUEST, $type);

        if ($this->headers) {
            curl_setopt( $init_request, CURLOPT_HTTPHEADER, $this->getHeaders());
        }

        if ($this->basic_auth) {
            curl_setopt( $init_request, CURLOPT_USERPWD, $this->basic_auth?->username . ":" . $this->basic_auth?->password);
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

    public function post(string $url, array $data = [], $query = []) {
        $this->request_url = $url;
        return $this->resolveRequest("POST", $data, $query);
    }

    public function patch(string $url, array $data = [], $query = []) {
        $this->request_url = $url;
        return $this->resolveRequest("PATCH", $data, $query);
    }

    public function put(string $url, array $data = [], $query = []) {
        $this->request_url = $url;
        return $this->resolveRequest("PUT", $data, $query);
    }

    public function delete(string $url, array $data = [], $query = []) {
        $this->request_url = $url;
        return $this->resolveRequest("DELETE", $data, $query);
    }



    public function get(string $url, $query = []) {
        $this->request_url = $url;
        return $this->resolveRequest("GET", [] , $query);
    }
}