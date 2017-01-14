<?php

namespace IceCreamDatabase;

use \PDO;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\Connection;
use IceCreamDatabase\Connections\ConnectionManager;

/**
 * This is how you connect to the database of your choice.
 *
 * Configuration is an array of driver => config:
 *
 * <pre>
 * $connections = [
 *  'mysql' => [
 *     'host' => '127.0.0.1',
 *     'port' => 3306,
 *     'database' => '',
 *     'username' => 'root',
 *     'password' => 'root',
 *     'charset' => 'utf8',
 *   ],
 *   'pgsql' => [
 *     'host' => '127.0.0.1',
 *     'port' => 5432,
 *     'dbname' => 'scotchbox',
 *     'username' => 'root',
 *     'password' => 'root',
 *     'charset' => 'utf8',
 *   ],
 * ]
 * </pre>
 *
 * This is then passed into constructor and the associated connections are created.
 *
 * You then have access to db() method where you can pass in a connection name of mysql or psql
 * to get the associated connection or pass in nothing and get the default connection.
 *
 * This is a thin wrapper around PDO so you have access to all the PDO methods and are responsible
 * for handling how you disconnect, which you can do by: $conn->manager->closeAllConnections() to close
 * all database connections.
 */
class Connect {

    private $_databaseDrivers = [];

    private $_connectionManager = null;

    /**
     * Connect to the database.
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->connect($config);
    }

    /**
     * Get the database connection.
     *
     * If no name is passed in, we return the derfault connection.
     *
     * @param String name - optional
     * @return \PDO
     */
    public function db($name = '') : PDO {
        return $this->_connectionManager->getConnection($name);
    }

    /**
     * Get the database connection manager.
     *
     * @return IceCreamDatabase\Connections\ConnectionManager
     */
    public function manager() : ConnectionManager {
        return $this->_connectionManager;
    }

    protected function connect(array $config) {
        $this->getDatabaseHandlers($config);
        $this->_connectionManager = new ConnectionManager($this->getConnections());
    }

    protected function getDatabaseHandlers(array $config) {
        foreach ($config as $name => $configuration) {
            $this->_databaseDrivers[$name] = (new DriverFactory($name, $configuration))->createDriverInstance();
        }
    }

    /**
     * Get an array of connections.
     *
     * This method is only public for testing purposes to be able to mock the method
     * and return fake PDO objects. You should enevr call this directly.
     *
     * @return Array ['driver_name' => \PDO, ...] 
     */
    public function getConnections() {
        $connections = [];

        foreach ($this->_databaseDrivers as $name => $driver) {
            $connections[$name] = (new Connection($name . ':' . $driver->connectionString(), $driver->username(), $driver->password()))->connect();
        }

        return $connections;
    }
}
