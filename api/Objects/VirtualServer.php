<?php

namespace Virtualizor\Objects;


/**
 * Class VirtualServer
 * @package Virtualizor\Objects
 * @see http://virtualizor.com/admin-api
 */
class VirtualServer
{

    private $client;
    private $userClient;

    public function __construct($client, $userClient)
    {
        $this->client = $client;
        $this->userClient = $userClient;
        return $this;
    }

    public function start($vmid)
    {
        return $this->client->start($vmid);
    }

    public function shutdown($vmid)
    {
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

    public function getInformation($vmid)
    {
        $data = $this->userClient->vpsinfo($vmid);
        $data = json_decode(json_encode($data), true);
        return $data['info'];
    }

    /**
     * @param integer $cores
     * @param integer $ram
     * @param integer $disk
     * @param string $storageid
     * @param integer $os
     * @param string $hostname
     * @param string $rootpassword
     * @param array $ipsv4
     * @param integer $ipv6
     * @param null $userid
     * @param null $mail
     * @param null $username
     * @param null $firstname
     * @param null $lastname
     * @return mixed
     */
    public function createKVM(int $cores, int $ram, int $disk, string $storageid, int $os, string $hostname, string $rootpassword, array $ipsv4, int $ipv6, $userid = null, $mail = null, $username = null, $firstname = null, $lastname = null)
    {
        $post = array();
        if (!empty($userid)) {
            $post['uid'] = $userid;
            $post['user_email'] = null;
            $post['user_pass'] = null;
            $post['fname'] = null;
            $post['lname'] = null;
        } else {
            $post['uid'] = null;
            $post['user_email'] = $mail;
            $post['user_pass'] = $username;
            $post['fname'] = $firstname;
            $post['lname'] = $lastname;
        }
        $post['virt'] = 'proxk';
        $post['osid'] = $os;
        $post['hostname'] = $hostname;
        $post['rootpass'] = $rootpassword;
        $post['ips'] = $ipsv4;
        $post['num_ips6_subnet'] = $ipv6;
        $post['space'] = array(0 => array(
            'size' => $disk,
            'st_uuid' => $storageid,
            'bus_driver' => 'virtio',
            'bus_driver_num' => 0));
        $post['ram'] = $ram; //
        $post['swapram'] = 1024;
        $post['bandwidth'] = 1024;
        $post['cores'] = $cores;
        $post['vnc'] = 1;
        $post['vncpass'] = 'test123';
        $post['vnc_keymap'] = 'de-de';

        return $this->client->addvs_v2($post);

    }

    /**
     * @param integer $cores
     * @param integer $ram
     * @param integer $disk
     * @param string $storageid
     * @param integer $os
     * @param string $hostname
     * @param string $rootpassword
     * @param array $ipsv4
     * @param integer $ipv6
     * @param null $userid
     * @param null $mail
     * @param null $username
     * @param null $firstname
     * @param null $lastname
     * @return mixed
     */
    public function createLXC(int $cores, int $ram, int $disk, string $storageid, int $os, string $hostname, string $rootpassword, array $ipsv4, int $ipv6, $userid = null, $mail = null, $username = null, $firstname = null, $lastname = null)
    {
        $post = array();
        if (!empty($userid)) {
            $post['uid'] = $userid;
            $post['user_email'] = null;
            $post['user_pass'] = null;
            $post['fname'] = null;
            $post['lname'] = null;
        } else {
            $post['uid'] = null;
            $post['user_email'] = $mail;
            $post['user_pass'] = $username;
            $post['fname'] = $firstname;
            $post['lname'] = $lastname;
        }
        $post['virt'] = 'proxl';
        $post['osid'] = $os;
        $post['hostname'] = $hostname;
        $post['rootpass'] = $rootpassword;
        $post['ips'] = $ipsv4;
        $post['num_ips6_subnet'] = $ipv6;
        $post['space'] = array(0 => array(
            'size' => $disk,
            'st_uuid' => $storageid,
            'bus_driver' => 'virtio',
            'bus_driver_num' => 0));
        $post['ram'] = $ram; //
        $post['swapram'] = 1024;
        $post['bandwidth'] = 1024;
        $post['cores'] = $cores;
        $post['vnc'] = 1;
        $post['vncpass'] = 'test123';
        $post['vnc_keymap'] = 'de-de';

        return $this->client->addvs_v2($post);

    }

    public function edit(int $id, string $hostname, string $rootpassword, array $ips, int $disk_size, string $disk_st_uuid, string $disk_uuid, int $ram, int $cores, int $backupserverid)
    {
        $post = array();
        $post['vpsid'] = $id;
        $post['hostname'] = $hostname;
        $post['rootpass'] = $rootpassword;
        $post['ips'] = $ips;
        $post['space'] = array(0 => array(
            'size' => $disk_size,
            'st_uuid' => $disk_st_uuid,
            'disk_uuid' => $disk_uuid
        )
        );
        $post['ram'] = $ram;
        $post['cores'] = $cores;
        $post['bpid'] = $backupserverid; //Backup server id
        $post['editvps'] = 1;

        return $this->client->editvs($post);
    }

    public function reinstall(int $id, int $os, string $password, int $installer = null)
    {
        $post = array();
        $post['vpsid'] = $id;
        $post['osid'] = $os;
        $post['newpass'] = $password;
        $post['conf'] = $password;
        if (!is_null($installer)) {
            $post['recipe'] = $installer;
        } else {
            $post['recipe'] = null;
        }
        return $this->client->rebuild($post);
    }

    public function getVNC(int $id)
    {
        $post = array();
        $post['novnc'] = $id;
        return $this->client->vnc($post);
    }

    public function delete(int $id)
    {
        return $this->client->delete_vs($id);
    }

    public function suspend(int $id)
    {
        return $this->client->suspend($id);
    }

    public function unSuspend(int $id)
    {
        return $this->client->unsuspend($id);
    }

    public function suspendNetwork(int $id)
    {
        return $this->client->suspend_net($id);
    }

    public function unSuspendNetwork(int $id)
    {
        return $this->client->unsuspend_net($id);
    }

    public function resetBandwidth(int $id)
    {
        return $this->client->resetbandwidth($id);
    }

    public function getTasks(int $id)
    {
        $post['act'] = "ctasks";
        $post['svs'] = $id;
        $data = $this->userClient->tasks($post);
        $data = json_decode(json_encode($data), true);
        return $data['tasks'];
    }


}
