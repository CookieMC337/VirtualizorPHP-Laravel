<?php

namespace Virtualizor\Objects;


class IPPool {
    private $client;

    public function __construct($client) {
        $this->client = $client;
        return $this;
    }

    public function listPools($page = 1, $amount = 200){
        return $this->client->ippool($page, $amount);
    }


    /**
     * @param int $iptype 4 (IPv4) / 6 (IPv6)
     * @param int $hostid nodeID
     * @param string $name
     * @param string $gateway
     * @param string $netmask
     * @param string $ns1
     * @param string $ns2
     * @param string $firstip
     * @param string $lastip
     * @param bool $nat
     * @return void
     */
    public function createPool(int $iptype, int $hostid, string $name, string $gateway, string $netmask, string $ns1, string $ns2, string $firstip, string $lastip, bool $nat = true){
        $post = array();
        $post['iptype'] = $iptype;
        $post['serid'] = $hostid;
        $post['ippool_name'] = $name;
        $post['gateway'] = $gateway;
        $post['netmask'] = $netmask;
        $post['ns1'] = $ns1;
        $post['ns2'] = $ns2;
        $post['firstip'] = $firstip;
        $post['lastip'] = $lastip;
        $post['routing'] = 1; //This is same for both IPv4 and IPv6
        if ($nat){
            $post['nat'] = 'on';
        }else{
            $post['nat'] = 'off';
        }

        return $this->client->addippool($post);
    }

    public function deletePool(int $id){
        $post = array();
        $post['delete'] = $id;
        return $this->client->deleteippool($post);
    }


    public function listIPv4(int $page, int $amount){
        return $this->client->ips($page, $amount);
    }

    public function listIPv6(int $page, int $amount){
        return $this->client->iprange($page, $amount);
    }

    public function searchIPv4(string $ip){
        $page = 1;
        $reslen = 100;
        $post = array();
        $post['ipsearch'] = $ip;
        $post['ippoolsearch'] = '';
        $post['macsearch'] = '';
        $post['vps_search'] = '';
        $post['servers_search'] = '';
        $post['lockedsearch'] = '';

        return $this->client->ips($page,$reslen ,$post);
    }


}