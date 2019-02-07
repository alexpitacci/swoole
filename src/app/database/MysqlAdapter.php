<?php

namespace App\Database;

use Swoole\Coroutine\Mysql;

class MysqlAdapter
{
    protected $_db;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_db = new Mysql();
        $this->_db->connect(array(
          'host' => 'db',
          'port' => 3306,
          'user' => 'root',
          'password' => 'MYSQLPASS',
          'database' => 'SWOOLE',
          'charset' => 'utf8',
          'timeout' => 2,
        ));
    }

    /**
     * Connect to MySQL
     */
    public function db()
    {
        return $this->_db;
    }

    public function query($sql) {
        return $this->_db->query($sql);
    }

    public function insert_id() {
        return $this->_db->insert_id;
    }

}
