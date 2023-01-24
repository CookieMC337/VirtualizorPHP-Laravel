<?php
namespace Virtualizor;

use Virtualizor\Base\Virtualizor_Enduser_API;
use Virtualizor\Objects\IPPool;
use Virtualizor\Objects\OSTemplates;
use Virtualizor\Objects\Users;
use Virtualizor\Objects\VirtualServer;
use Virtualizor\Base\Virtualizor_Admin_API;

class Virtualizor {
    /**
     * @var Virtualizor_Admin_API
     */
    private $client;
    /**
     * @var Virtualizor_Admin_API
     */
    private $userClient;

    public function __construct($ip, $key, $pass, $adminPort = '4085', $clientPort = '4083') {
        $this->client = new Virtualizor_Admin_API($ip, $key, $pass, $adminPort);
        $this->userClient = new Virtualizor_Enduser_API($ip, $key, $pass, $clientPort, 1);
    }

    public function server(): VirtualServer
    {
        return new VirtualServer($this->client, $this->userClient);
    }

    public function osTemplates(): OSTemplates
    {
        return new OSTemplates($this->client, $this->userClient);
    }

    public function IPPool(): IPPool
    {
        return new IPPool($this->client, $this->userClient);
    }

    public function Users(): Users
    {
        return new Users($this->client, $this->userClient);
    }
}