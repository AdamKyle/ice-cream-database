<?php

namespace IceCreamDatabase\Drivers\PgSql;

use IceCreamDatabase\Drivers\BaseDriver;

/**
 * Creates the connection string for PgSql.
 */
class PgSqlDriver extends BaseDriver {

    private $_charSet = '';

    public function __construct(array $configuration) {
        parent::__construct($configuration);

        if (isset($configuration['charset'])) {
            $this->_charSet = "options='--client_encoding=" .$configuration['charset']. "';";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function connectionString(): String {

        if ($this->_charSet !== '') {
            return $this->_configurationString .= $this->_charSet;
        }

        return $this->_configurationString;

    }
}
