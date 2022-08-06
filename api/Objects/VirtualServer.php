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

    public function getInformation($vmid){
        $data =  $this->client->status($vmid);
        $resp = array(
            "status" => $data[$vmid]->status,
            "used_cpu" => $data[$vmid]->used_cpu,
            "used_ram" => $data[$vmid]->used_ram,
            "used_disk" => $data[$vmid]->used_disk,
            "net_in" => $data[$vmid]->net_in,
            "net_out" => $data[$vmid]->net_out,
            "used_inode" => $data[$vmid]->used_inode,
            "io_read" => $data[$vmid]->io_read,
            "io_write" => $data[$vmid]->io_write,
            "inode" => $data[$vmid]->inode,
            "ram" => $data[$vmid]->ram,
            "disk" => $data[$vmid]->disk,
            "used_bandwidth" => $data[$vmid]->used_bandwidth,
            "bandwidth" => $data[$vmid]->bandwidth,
            "virt" => $data[$vmid]->virt,
        );

        return $data;
    }

}