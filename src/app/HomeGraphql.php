<?php
namespace App;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\Types;

class HomeGraphql {

    public static function run($data) {

        $schema = new Schema([
            'query' => Types::query()
        ]);
        
        //$rawInput = file_get_contents('php://input');
        //$input = json_decode($rawInput, true);
        $input = json_decode($data, true);
        
        $query = $input['query'];
        $variableValues = isset($input['variables']) ? $input['variables'] : null;
        
        try {
            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
        
        return json_encode($output);
    }
}