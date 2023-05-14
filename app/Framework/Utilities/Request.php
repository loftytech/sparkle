<?php
namespace App\Framework\Utilities;

class Request {
    public object $params;
    public object $query;
    public object $body;
    public object $extras;

    public function __construct(array $params = [], array $query = [], array $body = []) {
        $this->params = (object) $params;
        $this->query = (object) $query;
        $this->body = (object) $body;
    }

    public function setExtras(array $data) {
        $this->extras = (object) $data;
    }
}

?>