<?php

namespace App\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use App\Types;
use App\Datasource;

class QueryType extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(Types::product()),
                    'description' => 'Lista de Produtos',
                    'resolve' => function ($val, $args) {
                       return $this->products($val, $args);
                    }
                ]
            ]
        ];

        parent::__construct($config);
    }

    public function products($rootValue, $args) {
        $ds = new Datasource();
        $products = $ds->select('select * from products');
        return $products;
    }
}
