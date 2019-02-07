<?php

namespace App\Entities;

use App\Database\MysqlAdapter;

abstract class Entity {

  protected $tableName;
  protected $adapter;

  public function __construct() {
    try {
        $this->adapter = new MysqlAdapter();
    } catch (\Exception $e) {
        throw new \Exception('Error creating a database connection ');
    }
  }

  public function save() {
    $class = new \ReflectionClass($this);
    $tableName = '';

    if ($this->tableName != '') {
      $tableName = $this->tableName;
    } else {
      $tableName = strtolower($class->getShortName());
    }
    $propsToImplode = [];

    foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) { // consider only public properties of the providen
      $propertyName = $property->getName();
      if (!$this->id && $propertyName == 'id') {
        continue;
      }
      $propsToImplode[] = '`'.$propertyName.'` = "'.$this->{$propertyName}.'"';
    }

    $setClause = implode(',',$propsToImplode); // glue all key value pairs together
    $sqlQuery = '';

    if ($this->id > 0) {
      $sqlQuery = 'UPDATE `'.$tableName.'` SET '.$setClause.' WHERE id = '.$this->id;
    } else {
      $sqlQuery = 'INSERT INTO `'.$tableName.'` SET '.$setClause;
    }

    $result = $this->adapter->query($sqlQuery);
    if (!$this->id ) {
      $this->id = $this->adapter->insert_id();
    }

    return $result;
  }

  /**
  *
  * @return Entity
  */
  public function morph(array $object) {
    $class = new \ReflectionClass(get_called_class()); // this is static method that's why i use get_called_class

    $entity = $class->newInstance();

    foreach($class->getProperties(\ReflectionProperty::PUBLIC) as $prop) {
      if (isset($object[$prop->getName()])) {
        $prop->setValue($entity,$object[$prop->getName()]);
      }
    }

    $entity->initialize(); // soft magic

    return $entity;
  }

  /**
  *
  * @return Entity[]
  */
  public function find ($options = []) {

    $result = [];
    $tableName = '';

    if ($this->tableName != '') {
      $tableName = $this->tableName;
    } else {
      $tableName = strtolower($class->getShortName());
    }
    $query = "select * from `{$tableName}`";

    $whereClause = '';
    $whereConditions = [];

    if (!empty($options)) {
      if (is_string($options)) {
        $whereClause = " WHERE ". $options;
      } else {
        foreach ($options as $key => $value) {
          $whereConditions[] = '`'.$key.'` = "'.$value.'"';
        }
        $whereClause = " WHERE ".implode(' AND ',$whereConditions);
      }
    }
    $result = $this->adapter->query($query . $whereClause);

    return $result;
  }

  public function findAll ($options = 'id > 0') {
    return $this->find($options);
  }
}

