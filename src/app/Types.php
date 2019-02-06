<?php

namespace App;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use App\Type\QueryType;
use App\Type\ProductType;
use App\Type\ProductInputType;
use App\Type\MutationType;

class Types {

    private static $product;
    private static $productInput;
    private static $query;
    private static $mutation;

    /**
     * @return ProductType
     */
    public static function product()
    {
        return self::$product ?: (self::$product = new ProductType());
    }

    /**
     * @return ProductInputType
     */
    public static function productInput()
    {
        return self::$productInput ?: (self::$productInput = new ProductInputType());
    }

    /**
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    /**
     * @return MutatitonType
     */
    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

}
