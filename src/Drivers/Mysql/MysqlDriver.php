<?php

namespace IceCreamDatabase\Drivers\Mysql;

use IceCreamDatabase\Drivers\BaseDriver;

class MysqlDriver extends BaseDriver {

    private $_charSet = '';

    public function __construct(array $configuration) {
        parent::__construct($configuration);

        if (isset($configuration['charset'])) {
            $this->_charSet = 'charset=' . $configuration['charset'] . ';';
        }
    }

    public function connectionString(): String {

        if ($this->_charSet !== '') {
            return $this->_configurationString .= $this->_charSet;
        }

        return $this->_configurationString;

    }
}
