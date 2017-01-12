<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\ConnectionManager;
use IceCreamDatabase\Connect;

use IceCreamDatabase\Tests\Mocks\PDOMock;

class ConnectTest extends \PHPUnit_Framework_TestCase {

    private $_pdo = null;

    private $_connectClass = null;

    private $_coreConfig = [];

    public function setUp() {
        parent::setUp();

        $this->_coreConfig = [
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
        ];

        $this->_pdo = $this->getMockBuilder(PDOMock::class)
                           ->getMock();

        $this->_connectClass = $this->getMockBuilder(Connect::class)
                           ->disableOriginalConstructor()
                           ->getMock();
    }

    public function tearDown() {
        $this->_pdo          = null;
        $this->_connectClass = null;
    }

    public function testGetDefaultPDOConnection() {
        $this->_connectClass->expects($this->any())
                            ->method('getConnections')
                            ->will($this->returnValue([
                                'mysql' => $this->_pdo,
                                'psql'  => $this->_pdo
                            ]));

        $this->_connectClass->__construct($this->_coreConfig);

        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db('mysql')); // Named
        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db('psql'));  // Named
        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db());        // Default
    }

    public function testGetConnectionManager() {
        $this->_connectClass->expects($this->any())
                            ->method('getConnections')
                            ->will($this->returnValue([
                                'mysql' => $this->_pdo,
                                'psql'  => $this->_pdo
                            ]));

        $this->_connectClass->__construct($this->_coreConfig);

        $this->assertInstanceOf(ConnectionManager::class, $this->_connectClass->manager());
    }

}
