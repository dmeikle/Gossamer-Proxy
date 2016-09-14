<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/10/2016
 * Time: 11:01 AM
 */

namespace core\components\security\core;


interface ServerInterface
{

    public function setApiKey($credentials);

    public function setIpAddress($ipAddress);

    public function getApiKey();

    public function getIpAddress();

    public function setStatus($status);

    public function getStatus();

    public function getId();
}
