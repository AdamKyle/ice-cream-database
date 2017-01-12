<?php

namespace IceCreamDatabase;

use \PDO;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\Connection;
use IceCreamDatabase\Connections\ConnectionManager;

class Connect {

    private $_config = [];

    private $_databaseDrivers = [];

    private $_connectionManager = null;

    public function __construct($config) {
        $this->_config = $config;

        $this->connect();
    }

    public function db($name = '') : PDO {
        return $this->_connectionManager->getConnection($name);
    }

    public function manager() : ConnectionManager {
        return $this->_connectionManager;
    }

    protected function connect() {
        $this->getDatabaseHandlers();
        $this->_connectionManager = new ConnectionManager($this->getConnections());
    }

    private function getDatabaseHandlers() {
        foreach ($this->_config as $name => $config) {
            $this->_databaseDrivers[$name] = (new DriverFactory($name, $config))->createDriverInstance();
        }
    }

    private function getConnections() {
        $connections = [];

        foreach ($this->_databaseDrivers as $name => $driver) {
            $connections[$name] = new Connection($name . ':' . $driver->connectionString(), $driver->username(), $driver->password());
        }

        return $connections;
    }
}
