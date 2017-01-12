<?php

namespace IceCreamDatabase\Drivers;

abstract class BaseDriver {

    protected $_configurationString = '';

    protected $_username = '';
    protected $_password = '';

    public function __construct(array $configuration) {
        if (isset($configuration['username'])) {
            $this->_username = $configuration['username'];
        }

        if (isset($configuration['password'])) {
            $this->_password = $configuration['password'];
        }

        $this->createConfigurationString($configuration);
    }

    abstract public function connectionString(): String;

    public function username(): String {
        return $this->_username;
    }

    public function password(): String {
        return $this->_password;
    }

    protected function createConfigurationString(array $configuration) {
        if (isset($configuration['host'])) {
            $this->_configurationString = 'host=' . $configuration['host'] . ';';
        }

        if (isset($configuration['port'])) {
            $this->_configurationString .= 'port=' . $configuration['port'] . ';';
        }

        if (isset($configuration['database'])) {
            $this->_configurationString .= 'database=' . $configuration['database'] . ';';
        }
    }
}
