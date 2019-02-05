<?php

namespace App\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use App\Types;

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
        require 'bootstrap.php';
        $productRepository = $entityManager->getRepository('Product');
        $products = $productRepository->findAll();
        var_dump($products);
        return $products;
    }
}