<?php

use IceCreamDatabase\Drivers\Mysql\MysqlDriver;
use IceCreamDatabase\Drivers\Pgsql\PgSqlDriver;
use IceCreamDatabase\Drivers\DriverFactory;
use IceCreamDatabase\Connections\ConnectionManager;

use IceCreamDatabase\Tests\Mocks\PDOMock;

class ConnectionManagerTest extends \PHPUnit_Framework_TestCase {

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

    public function testShouldReturnFalseSetDefaultConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertFalse($cm->setDefaultConnection('sdasdsa'));
    }

    public function testShouldReturnFalseForClosingAConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertFalse($cm->closeConnection('sdasdsa'));
    }

    public function testShouldReturnTrueForClosingAConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertTrue($cm->closeConnection('mysql'));
    }

    public function testShouldReturnNullForAClosedConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);
        $cm->closeConnection('mysql');

        $this->assertNull($cm->getConnection('mysql'));
    }

    public function testShouldReturnNullForAllClosedConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);
        $cm->closeAllConnections();

        $this->assertNull($cm->getConnection('mysql'));
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
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
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

    public function testShouldCloseConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertTrue($cm->closeConnection('mysql'));
        $this->assertNull($cm->getConnection('mysql'));
    }

    public function testShouldNotCloseConnection() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $this->assertFalse($cm->closeConnection('adsdsad'));
        $this->assertNotNull($cm->getConnection('mysql'));
    }

    public function testShouldCloseAllConnections() {
        $connections = [
            'mysql' => $this->_pdo,
            'pgsql' => $this->_pdo,
        ];

        $cm = new ConnectionManager($connections);

        $cm->closeAllConnections();
        
        $this->assertNull($cm->getConnection('mysql')); // Named
        $this->assertNull($cm->getConnection('pgsql')); // Named
        $this->assertNull($cm->getConnection());        // default
    }
}
