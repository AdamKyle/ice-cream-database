<?php

use IceCreamDatabase\Drivers\Sqlite\SqliteDriver;
use PHPUnit\Framework\TestCase;

class SqliteDriverTest extends TestCase {

    private $_configuration = [];

    public function setUp() {
        parent::setUp();

        // Random Configu Object For Base Driver.
        $this->_configuration = [
            'temp_file' => ':memory',
        ];
    }


    public function testConnectionString() {
        $this->assertEquals(
            ":memory;",
            (new SqliteDriver($this->_configuration))->connectionString()
        );
    }

}
