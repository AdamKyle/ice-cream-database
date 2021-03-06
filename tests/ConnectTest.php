<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\ConnectionManager;
use IceCreamDatabase\Connect;
use PHPUnit\Framework\TestCase;
use IceCreamDatabase\Tests\Mocks\PDOMock;

class ConnectTest extends TestCase {

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
            'sqlite' => [
                'temp_file' => ':memory',
            ]
        ];

        $this->_pdo = $this->getMockBuilder(PDOMock::class)
                           ->getMock();

        $this->_connectClass = $this->getMockBuilder(Connect::class)
                           ->disableOriginalConstructor()
                           ->getMock();
    }

    public function tearDown() {
        parent::tearDown();

        $this->_pdo          = null;
        $this->_connectClass = null;
    }

    public function testGetDefaultPDOConnection() {
        $this->_connectClass->expects($this->any())
                            ->method('getConnections')
                            ->will($this->returnValue([
                                'mysql'  => $this->_pdo,
                                'psql'   => $this->_pdo,
                                'sqlite' => $this->_pdo
                            ]));

        $this->_connectClass->__construct($this->_coreConfig);

        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db('mysql')); // Named
        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db('psql'));  // Named
        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db('sqlite'));  // Named
        $this->assertInstanceOf(\PDO::class, $this->_connectClass->db());        // Default
    }

    public function testGetConnectionManager() {
        $this->_connectClass->expects($this->any())
                            ->method('getConnections')
                            ->will($this->returnValue([
                                'mysql'  => $this->_pdo,
                                'psql'   => $this->_pdo,
                                'sqlite' => $this->_pdo
                            ]));

        $this->_connectClass->__construct($this->_coreConfig);

        $this->assertInstanceOf(ConnectionManager::class, $this->_connectClass->manager());
    }
}
