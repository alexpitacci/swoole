<?php

namespace App\Entities;

class Product extends Entity {

  protected $tableName = 'products'; // usually tables are named in plural when the object should be named singular

  public $id;
  public $name;
}
