<?php

namespace App\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use App\Types;
use App\Datasource;
use App\Entity\Product;

class MutationType extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Mutation',
            'fields' => [
                'createProduct' => [
                  'args' => [
                    'product' => Types::productInput()
                  ],
                  'type' => Types::product(),
                  'description' => 'Create new Product',
                  'resolve' => function($val, $args) {
                    return $this->createProduct($val, $args);
                  }
                ],
            ]
        ];
        parent::__construct($config);
    }

    public function createProduct($val, $args) {
      $ds = new Datasource();
      $obj = (object) $args['product'];
      $id = $ds->insert("INSERT INTO `SWOOLE`.`products` (`name`) VALUES ('{$obj->name}')");
      $product = $ds->select("SELECT * FROM `SWOOLE`.`products` WHERE `id` = {$id}");
      return $product[0];
    }
}
