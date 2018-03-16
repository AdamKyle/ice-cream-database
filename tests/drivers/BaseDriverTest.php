<?php

use IceCreamDatabase\Drivers\BaseDriver;
use PHPUnit\Framework\TestCase;

class BaseDriverTest extends TestCase {

    private $_baseDriverMock = null;

    public function setUp() {
        parent::setUp();

        // Random Configu Object For Base Driver.
        $baseDriverConfig = [
            'host' => '127.0.0.1',
            'port' => 3306,
            'database' => 'nameOfDatabase',
            'username' => 'WhoAreYou',
            'password' => 'password',
            'charset' => 'utf8',
        ];

        $this->_baseDriverMock = $this->getMockForAbstractClass(BaseDriver::class, [$baseDriverConfig]);
    }

    public function testUserNameExists() {
        $this->assertEquals('WhoAreYou', $this->_baseDriverMock->username());
    }

    public function testPasswordExists() {
        $this->assertEquals('password', $this->_baseDriverMock->password());
    }

    public function testCreateConnectionString() {
        $this->_baseDriverMock->expects($this->any())
                              ->method('connectionString')
                              ->will($this->returnValue('host=127.0.0.1;port=3306;database=nameOfDatabase;'));

        $this->assertEquals('host=127.0.0.1;port=3306;database=nameOfDatabase;', $this->_baseDriverMock->connectionString());
    }
}
