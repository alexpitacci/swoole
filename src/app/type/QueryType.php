<?php

namespace App\Type;

require 'bootstrap.php';

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
                    'type' => Types::listOf(Types::product()),
                    'description' => 'Lista de Produtos'
                ]
            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {
                 return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];

        parent::__construct($config);
    }

    public function products($rootValue, $args) {

        $productRepository = Datasource::em()->getRepository('Product');
        $products = $productRepository->findAll();
        var_dump($products);
        return $products;
    }
}
