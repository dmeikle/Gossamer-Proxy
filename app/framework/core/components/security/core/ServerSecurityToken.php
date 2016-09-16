<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/10/2016
 * Time: 2:35 PM
 */

namespace core\components\security\core;


class ServerSecurityToken implements TokenInterface
{

    public function toString() {
        // TODO: Implement toString() method.
    }

    public function getRoles() {
        // TODO: Implement getRoles() method.
    }

    public function getClient() {
        // TODO: Implement getClient() method.
    }

    public function setClient(Client $client) {
        // TODO: Implement setClient() method.
    }

    public function getIdentity() {
        // TODO: Implement getIdentity() method.
    }

    public function isAuthenticated() {
        // TODO: Implement isAuthenticated() method.
    }

    public function setAuthenticated($isAuthenticated) {
        // TODO: Implement setAuthenticated() method.
    }

    public function setAttribute($name, mixed $value) {
        // TODO: Implement setAttribute() method.
    }

    public function getAttributes() {
        // TODO: Implement getAttributes() method.
    }

    public function setAttributes(array $attributes) {
        // TODO: Implement setAttributes() method.
    }

    public function eraseCredentials() {
        // TODO: Implement eraseCredentials() method.
    }
}