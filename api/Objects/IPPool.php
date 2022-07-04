<?php

namespace Virtualizor\Objects;


class IPPool {
    private $client;

    public function __construct($client) {
        $this->client = $client;
        return $this;
    }
}