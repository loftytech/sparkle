<?php
namespace App\Framework\Utilities;

class Request {
    public object $params;
    public object $headers;
    public string $path;
    public string $method;
    public object $query;
    public object $body;
    public object $extras;

    public function __construct(string $method, string $path, array $params = [], array $query = [], array $body = [], array $headers = []) {
        $this->params = (object) $params;
        $this->query = (object) $query;
        $this->headers = (object) $headers;
        $this->path = $path;
        $this->method = strtolower($method);
        $this->body = (object) json_decode(json_encode($body), false);
        $this->extras = (object) [];
    }

    public function setExtras(array $data) {
        $this->extras = (object) $data;
    }
}

?>