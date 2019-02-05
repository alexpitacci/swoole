<?php
namespace App;

class Datasource {

  public static function em() {
    require 'bootstrap.php';
    return $entityManager;
  }
}
