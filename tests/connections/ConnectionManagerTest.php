<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\ConnectionManager;
use PHPUnit\Framework\TestCase;
use IceCreamDatabase\Tests\Mocks\PDOMock;

class ConnectionManagerTest extends TestCase {

    private $_databaseConnectionConfig = [];

    private $_pdo = null;

    public function setUp() {
        parent::setUp();

        $this->_pdo = $this->getMockBuilder(PDOMock::class)
                           ->getMock();
    }

    public function tearDown() {
        $this->_pdo = null;
    }

    /**
     * @expectedException Exception
     */
    public function testThrowExceptionWhenConnectionArrayIsEmptyOnInstantiation() {
        new ConnectionManager([]);
    }

    public function testDefaultConnectionShouldNotBeNull() {
        $connections = [
            'mysql' => $this->_pdo,
        ];

        $this->assertNotNull((new ConnectionManager($connections))->getConnection());
    }

    public function testSetPSQLAsDefaultConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertTrue($cm->setDefaultConnection('pgsql'));
    }

    public function testSetSqliteAsDefaultConnection() {
        $connections = [
            'mysql'  => $this->_pdo,
            'pgsql'  => $this->_pdo,
            'sqlite' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertTrue($cm->setDefaultConnection('sqlite'));
    }

    public function testShouldReturnFalseSetDefaultConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertFalse($cm->setDefaultConnection('sdasdsa'));
    }

    public function testShouldReturnInstanceOfDefaultPdo() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        // If we can't find the connection, return default:
        $this->assertInstanceOf(\PDO::class, $cm->getConnection('dfdsf'));
    }

    public function testShoudSetNewDefaultConnection() {
        $connections = [
            'mysql'  => $this->_pdo,
            'pgsql'  => $this->_pdo,
            'sqlite' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertTrue($cm->setDefaultConnection('pgsql'));
    }

    public function testShoudNotSetNewDefaultConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertFalse($cm->setDefaultConnection('888'));
        $this->assertInstanceOf(\PDO::class, $cm->getConnection());
    }

    public function testShouldReturnConnectionName() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
            'sqlite' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertEquals('mysql', $cm->getCurrentConnectionName());
    }

    public function testShouldReturnConnectionNameEvenWhenSettingDefault() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
            'sqlite' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        // Default is Mysql:
        $this->assertEquals('mysql', $cm->getCurrentConnectionName());

        // Change to sqlite:
        $cm->setDefaultConnection('sqlite');

        // Now it should be sqlite:
        $this->assertNotEquals('mysql', $cm->getCurrentConnectionName());
        $this->assertEquals('sqlite', $cm->getCurrentConnectionName());
    }
}
