<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use PHPUnit\Framework\TestCase;

class MysqlDriverTest extends TestCase {

    private $_configuration = [];

    public function setUp() {
        parent::setUp();

        // Random Configu Object For Base Driver.
        $this->_configuration = [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'nameOfDatabase',
            'username' => 'WhoAreYou',
            'password' => 'password',
            'charset' => 'utf8',
        ];
    }

    public function testConnectionString() {
        $this->assertEquals(
            'host=127.0.0.1;port=3306;database=nameOfDatabase;charset=utf8;',
            (new MysqlDriver($this->_configuration))->connectionString()
        );
    }

}
