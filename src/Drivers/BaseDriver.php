<?php

namespace IceCreamDatabase\Drivers;

/**
 * Extend this class to create a driver.
 *
 *
 * Responsible for storing basic information about the driver
 * and how to connect to it.
 *
 * Creates the basic configiuration string (some drivers may need to do some extra work)
 * and stores the user name and password for the connection to the database which should
 * come from the enviroment file.
 */
abstract class BaseDriver {

    protected $_configurationString = '';

    protected $_username = '';
    protected $_password = '';

    /**
     * Configuration informatiuon for the database.
     *
     * @param array $configuration
     */
    public function __construct(array $configuration) {
        if (isset($configuration['username'])) {
            $this->_username = $configuration['username'];
        }

        if (isset($configuration['password'])) {
            $this->_password = $configuration['password'];
        }

        $this->createConfigurationString($configuration);
    }

    /**
     * This function returns the $_configurationString
     *
     * Use this functions to append information to the protected $_configurationString
     * and then return that as the connection string.
     *
     * @return String
     */
    abstract public function connectionString(): String;

    /**
     * Gets the username for the database.
     *
     * @return String
     */
    public function username(): String {
        return $this->_username;
    }

    /**
     * Gets the password for the database.
     *
     * @return String
     */
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

        // MYSQL
        if (isset($configuration['database'])) {
            $this->_configurationString .= 'database=' . $configuration['database'] . ';';
        }

        // PGSQL
        if (isset($configuration['dbname'])) {
            $this->_configurationString .= 'dbname=' . $configuration['dbname'] . ';';
        }

        // Sqlite
        if (isset($configuration['temp_file'])) {
            $this->_configurationString .= $configuration['temp_file'] . ';';
        }
    }
}
