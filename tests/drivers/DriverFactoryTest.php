<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;
use IceCreamDatabase\Drivers\Sqlite\SqliteDriver;
use IceCreamDatabase\Drivers\DriverFactory;

class DriverFactoryTest extends \PHPUnit_Framework_TestCase {

    private $_databaseConnectionConfig = [];

    public function setUp() {
        parent::setUp();

        $this->_databaseConnectionConfig = [
            'mysql' => [
              'host' => '127.0.0.1',
              'port' => 3306,
              'database' => 'nameOfDatabase',
              'username' => 'WhoAreYou',
              'password' => 'password',
              'charset' => 'utf8',
            ],
            'pgsql' => [
              'host' => '127.0.0.1',
              'port' => 3306,
              'database' => 'nameOfDatabase',
              'username' => 'WhoAreYou',
              'password' => 'password',
              'charset' => 'utf8',
            ],
            'sqlite' => [
                'temp_file' => ':memory'
            ]
        ];
    }

    public function testGetMySqlDriverInstance() {
        $this->assertInstanceOf(
            MysqlDriver::class,
            (new DriverFactory(
                'mysql',
                $this->_databaseConnectionConfig['mysql'])
            )->createDriverInstance()
        );
    }

    public function testGetPgsqlDriverInstance() {
        $this->assertInstanceOf(
            PgSqlDriver::class,
            (new DriverFactory(
                'pgsql',
                $this->_databaseConnectionConfig['pgsql'])
            )->createDriverInstance()
        );
    }

    public function testGetSqliteDriverInstance() {
        $this->assertInstanceOf(
            SqliteDriver::class,
            (new DriverFactory(
                'sqlite',
                $this->_databaseConnectionConfig['sqlite'])
            )->createDriverInstance()
        );
    }

    /**
     * @expectedException Exception
     */
    public function testThrowExceptionWhenCannotFindOrCreateDriverInstance() {
        (new DriverFactory('', []))->createDriverInstance();
    }

}
