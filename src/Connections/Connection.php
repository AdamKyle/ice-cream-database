<?php

namespace IceCreamDatabase\Connections;

use \PDO;

class Connection extends PDO {

    private $_dsn      = '';
    private $_username = '';
    private $_password = '';

    public function __construct($dsn, $username, $password) {
        $this->_dsn      = $dsn;
        $this->_username = $username;
        $this->_password = $password;
    }

    public function connect() {
        parent::__construct(
            $this->_dsn,
            $this->_username,
            $this->_password
        );

        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this;
    }
}
