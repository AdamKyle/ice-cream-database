<?php

namespace IceCreamDatabase\Connections;

use \PDO;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\Connection;

/**
 * Manage database connections.
 *
 * We store a seet of connections based on your connection array and then
 * allow you the developer to handle how those connections are managed.
 *
 * When storing one or more, we use the first connection as the default connection.
 * This can be changed via the setDefaultConnection method.
 *
 * Its important to know that connections must be closed by the developer, we do not handle
 * closing and opening connections.
 */
class ConnectionManager  {

    private $_connections = [];

    private $_driverInstances = [];

    private $_defaultConnection = null;

    /**
     * Takes in a set of connections and stores them.
     *
     * Connections cannot be empty.
     *
     * Connections are a associative array of name => \PDO connection.
     *
     * @param array $connections
     * @throws \Exception
     */
    public function __construct(array $connections) {
        if (empty($connections)) {
            throw new \Exception(
                'Connections Array Cannot Be Empty.'
            );
        }

        $this->storeAllContections($connections);
    }

    /**
     * Get all the connections registered.
     *
     * Some connections may be NULL, due to being closed.
     *
     * @return array
     */
    public function getAllConnections() {
        return $this->_connections;
    }

    /**
     * Get the specified connection, default connection or return null
     *
     * @param String name - optional
     * @return PDO or null
     */
    public function getConnection($name = '') {
        if (isset($this->_connections[$name])) {
            return $this->_connections[$name];
        }

        if (is_null($this->_defaultConnection)) {
             return null;
        }

        return current($this->_defaultConnection);
    }

     /**
      * Set a default connection other then whats already set.
      *
      * By default if you have more then one connection the first connection is the default.
      * How ever you can set a different connection as a default.
      *
      * If the connection cannot be found we return false.
      *
      * @param String name
      * @return bool
      */
    public function setDefaultConnection(String $name) {
        if (isset($this->_connections[$name])) {
            $this->_defaultConnection[$name] = $this->_connections[$name];
            return true;
        }

        return false;
    }

    protected function storeAllContections(array $connections) {
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
