<?php

namespace IceCreamDatabase\Drivers;

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;

class DriverFactory {

    private $_type;
    private $_configuration;

    public function __construct(String $type, Array $configuration) {
        $this->_type          = $type;
        $this->_configuration = $configuration;
    }

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
