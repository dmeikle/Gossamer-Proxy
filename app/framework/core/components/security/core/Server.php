<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/10/2016
 * Time: 11:00 AM
 */

namespace core\components\security\core;


class Server extends Client implements ServerInterface
{

    private $apiKey;
    private $serverName;

    public function __construct(array $params = null)
    {
        if(is_null($params)) {
            return;
        }
        if(array_key_exists('apiKey', $params)) {
            $this->setApiKey($params['apiKey']);
        }
        if(array_key_exists('serverName', $params)) {
            $this->setServerName($params['serverName']);
        }
        if(array_key_exists('ipAddress', $params)) {
            $this->setIpAddress($params['ipAddress']);
        }
        if(array_key_exists('status', $params)) {
            $this->setStatus($params['status']);
        }
        if(array_key_exists('id', $params)) {
            $this->id = ($params['id']);
        }
        if(array_key_exists('roles', $params)) {
            $this->setRoles(explode(',', $params['roles']));
        }
    }

    public function setApiKey($credentials)
    {
        $this->apiKey = $credentials;
    }

    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setServerName($name) {
        $this->serverName = $name;
    }

    public function getServerName() {
        return $this->serverName;
    }
}