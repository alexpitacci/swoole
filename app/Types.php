<?php

namespace App;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use App\Type\QueryType;
use App\Type\ProductType;

class Types {

    private static $product;
    private static $query;

    /**
     * @return ProductType
     */
    public static function product()
    {
        return self::$product ?: (self::$product = new ProductType());
    }

    /**
     * @return \GraphQL\Type\Definition\IDType
     */
    public static function id()
    {
        return Type::id();
    }

    /**
     * @return \GraphQL\Type\Definition\StringType
     */
    public static function string()
    {
        return Type::string();
    }

    /**
     * @param Type $type
     * @return ListOfType
     */
    public static function listOf($type)
    {
        return new ListOfType($type);
    }

    /**
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

}