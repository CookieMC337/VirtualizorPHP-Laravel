<?php
namespace Virtualizor\Objects;


class OSTemplates {

    private $client;

    public function __construct($client) {
        $this->client = $client;
        return $this;
    }
}