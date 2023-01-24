<?php

namespace Virtualizor\Objects;

class Users
{
    private $client;
    private $userClient;

    public function __construct($client, $userClient)
    {
        $this->client = $client;
        $this->userClient = $userClient;
        return $this;
    }

    public function list(int $page = 1, int $amount = 100)
    {
        return $this->client->users($page, $amount);
    }

    public function get(string $uid = null, string $email = null)
    {
        $page = 1;
        $reslen = 20;
        $post = array();
        if (!is_null($uid)) {
            $post['uid'] = $uid;
        } elseif (!is_null($email)) {
            $post['email'] = $email;
        }
        return $this->client->users($page, $reslen, $post);
    }

    public function addUser(string $email, string $password, string $fistname, string $lastname, bool $clouduser, int $bandwith = 0, int $cores = 0, int $network_speed = 0, int $ipv4 = 0, int $ipv6 = 0, int $ram = 0, int $disk = 0)
    {
        $post = array();
        $post['adduser'] = 1;

        $post['newemail'] = $email;
        $post['newpass'] = $password;
        $post['firstname'] = $fistname;
        $post['lastname'] = $lastname;

        if ($clouduser) {
            $post['priority'] = 3;
            $post['bandwidth'] = $bandwith;
            $post['network_speed'] = $network_speed;
            $post['cpu'] = 1;
            $post['num_cores'] = $cores;
            $post['num_ipv4'] = $ipv4;
            $post['num_ipv6_subnet'] = $ipv6;
            $post['ram'] = $ram;
            $post['space'] = $disk;
        } else {
            $post['priority'] = 0;
        }

        return $this->client->adduser($post);

    }

}