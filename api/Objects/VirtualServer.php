<?php

namespace Virtualizor\Objects;


/**
 * Class VirtualServer
 * @package Virtualizor\Objects
 * @see http://virtualizor.com/admin-api/#create-vps
 */
class VirtualServer {

    private $client;

    public function __construct($client) {
        $this->client = $client;
        return $this;
    }

    public function start($vmid)
    {
        return $this->client->start($vmid);
    }

    public function shutdown($vmid){
        return $this->client->stop($vmid);
    }

    public function stop($vmid)
    {
        return $this->client->poweroff($vmid);
    }

    public function restart($vmid)
    {
        return $this->client->restart($vmid);
    }


}