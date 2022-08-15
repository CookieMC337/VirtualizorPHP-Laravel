<?php
namespace Virtualizor\Objects;

class OSTemplates {

    private $client;

    public function __construct($client) {
        $this->client = $client;
        return $this;
    }

    public function getOSList(){
        return $this->client->list_distros();
    }
}