<?php

namespace IceCreamDatabase\Drivers;

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\PgSql\PgSqlDriver;

/**
 * Returns the appropriate driver for the connection.
 *
 * Simple factory to determine if we need a PSQL or MYSQL driver
 * returned based on the type.
 */
class DriverFactory {

    private $_type;
    private $_configuration;

    /**
     * Accepts the type and the configuration to return a driver.
     *
     * @param String $type
     * @param Array $configuration
     */
    public function __construct(String $type, Array $configuration) {
        $this->_type          = $type;
        $this->_configuration = $configuration;
    }

    /**
     * Creates a driver instance for connecting to the database.
     *
     * @return Mysql or Psql Driver
     * @throws \Exception when driver cannot be found.
     */
    public function createDriverInstance() {
        switch (strtolower($this->_type)) {
            case 'mysql':
                return new MysqlDriver($this->_configuration);
            case 'pgsql':
                return new PgSqlDriver($this->_configuration);
            default:
                throw new \Exception('Could not create driver instance. Driver not found.');
        }
    }
}
