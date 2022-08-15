<?php
namespace Virtualizor;

use Virtualizor\Objects\IPPool;
use Virtualizor\Objects\OSTemplates;
use Virtualizor\Objects\VirtualServer;
use Virtualizor\Base\Virtualizor_Admin_API;

class Virtualizor {
    /**
     * @var Virtualizor_Admin_API
     */
    private $client;

    public function __construct($ip, $key, $pass, $port = '4085') {
        $this->client = new Virtualizor_Admin_API($ip, $key, $pass, $port);
    }

    public function server(): VirtualServer
    {
        return new VirtualServer($this->client);
    }

    public function osTemplates(): OSTemplates
    {
        return new OSTemplates($this->client);
    }

    public function IPPool(): IPPool
    {
        return new IPPool($this->client);
    }

    public function getStorages(int $page = 1, int $reslen = 50){
        $post = array();
        $post['name'] = '';
        $post['path'] = '';

        return $this->client->storages($post, $page, $reslen);
    }

}