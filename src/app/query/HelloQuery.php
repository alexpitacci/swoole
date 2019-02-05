<?php

namespace App\Query;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class HelloQuery extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::listOf(Type::string()),
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
            ],
        ];
        parent::__construct($config);
    } 

    function resolve() {
        $productRepository = $entityManager->getRepository('Product');
        $products = $productRepository->findAll();
        return \json_encode($products);
    }
}