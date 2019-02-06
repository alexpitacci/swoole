<?php
namespace App\Type;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Types;

class ProductType extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Product',
            'description' => 'Products',
            'fields' =>  [
                'id' => Type::id(),
                'name' => Type::string()
            ],
        ];
        parent::__construct($config);
    }
}
