<?php

namespace IceCreamDatabase\Drivers\Sqlite;

use IceCreamDatabase\Drivers\BaseDriver;

/**
 * Creates the connection string for PgSql.
 */
class SqliteDriver extends BaseDriver {

    private $_charSet = '';

    public function __construct(array $configuration) {
        parent::__construct($configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function connectionString(): String {
        return $this->_configurationString;
    }
}
