<?php

namespace App\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

class ProductInputType extends InputObjectType {

  public function __construct() {
    $config = [
        'name' => 'ProductFiltersInput',
        'description' => 'Products Input',
        'fields' =>  [
            'id' => Type::id(),
            'name' => Type::string()
        ],
    ];
    parent::__construct($config);
  }
}
