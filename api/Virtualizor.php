<?php
namespace Virtualizor;

use Virtualizor\Objects\IPPool;
use Virtualizor\Objects\OSTemplates;
use Virtualizor\Objects\VirtualServer;
use Virtualizor_Admin_API;

class Virtualizor {
    public function __construct($ip, $key, $pass, $port = '4085') {
        $this->client = new Virtualizor_Admin_API($ip, $key, $pass, $port);
    }


    public function server(){
        return new VirtualServer($this->client);
    }

    public function osTemplates(){
        return new OSTemplates($this->client);
    }

    public function IPPool(){
        return new IPPool($this->client);
    }

}