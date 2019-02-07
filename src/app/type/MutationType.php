<?php

namespace App\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use App\Types;
use App\Entities\Product;

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

      $obj = (object) $args['product'];
      $product = new Product();
      $product->name = $obj->name;
      $product->save();

      return $product;
    }
}
