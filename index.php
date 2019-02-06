<?php
require_once 'vendor/autoload.php';

use Swoole\Http\Response;
use Swoole\Http\Server;
use App\HomeGraphql;

$http = new Server('0.0.0.0', 9501);
$http->set([
    'worker_num' => 4,
]);
$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});
$http->on('request', function ($request, Response $response)  {
    $route = substr($request->server['request_uri'],1);
    if ($route === 'graphql') {
        $response->header('Content-Type', 'application/json');
        $content = $request->rawContent();
        $response->end(HomeGraphql::run($content));
    } else {
        $response->end('Hello world! '. $route);
    }
});
$http->start();
