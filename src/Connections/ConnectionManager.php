<?php

namespace IceCreamDatabase\Connections;

use \PDO;
use \PDOException;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\Connection;

class ConnectionManager  {

    private $_connections = [];

    private $_driverInstances = [];

    private $_defaultConnection = null;

    public function __construct(array $connections) {
        if (empty($connections)) {
            throw new \Exception(
                'Connections Array Cannot Be Empty.'
            );
        }

        $this->storeAllContections($connections);
    }

    public function getAllConnections() {
        return $this->_connections;
    }

    public function getConnection($name = '') {
        if (isset($this->_connections[$name])) {
            return $this->_connections[$name];
        }

        if (is_null($this->_defaultConnection)) {
             return null;
        }

        return current($this->_defaultConnection);
    }

    public function setDefaultConnection(String $name) {
        if (isset($this->_connections[$name])) {
            $this->_defaultConnection[$name] = $this->_connections[$name];
            return true;
        }

        return false;
    }

    public function closeConnection($name) {
        if (isset($this->_connections[$name])) {
            $this->_connections[$name] = null;

            if (isset($this->_defaultConnection[$name])) {
                $this->_defaultConnection = null;
            }

            return true;
        }

        return false;
    }

    public function closeAllConnections() {
        forEach($this->_connections as $name => $pdoConnection) {
            $this->_connections[$name] = null;
        }

        $this->_defaultConnection = null;
    }


    protected function storeAllContections(array $connections) {
        var_dump($connections);
        foreach ($connections as $name => $connection) {
            if (!$connection instanceof PDO) {
                throw new \Exception('connection must be instance of PDO');
            }

            $this->_connections[$name] = $connection;
        }

        reset($this->_connections);
        $this->setDefaultConnection(key($this->_connections));
    }
}
