<?php

namespace App;

use Swoole\Coroutine\Mysql;

class Datasource {

    protected $db;

    public function __construct() {

    $this->db = new Mysql();
    $this->db->connect(array(
      'host' => 'db',
      'port' => 3306,
      'user' => 'root',
      'password' => 'MYSQLPASS',
      'database' => 'SWOOLE',
      'charset' => 'utf8',
      'timeout' => 2,
    ));
  }


  public function select($sql) {
    $stmt = $this->db->prepare($sql);
    $ret = $stmt->execute();
    return $ret;
  }

  public function insert($sql) {
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->insert_id;
  }
}
