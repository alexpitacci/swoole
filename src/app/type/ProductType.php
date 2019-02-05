<?php
namespace App\Type;

use GraphQL\Type\Definition\ObjectType;
use App\Types;

class ProductType extends ObjectType {
    
    public function __construct() {
        $config = [
            'name' => 'Product',
            'description' => 'Products',
            'fields' =>  [
                'id' => Types::id(),
                'name' => Types::string()
            ],
            'resolveType' =>  function ($object) {
                return $this->resolveType($object);
            }
        ];
        parent::__construct($config);
    }

    public function resolveType($object) {
        return Types::product();
    }
}