<?php

require __DIR__ . '/../../bootstrap.php';

//Now we can start creating a redis client to publish event
$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "127.0.0.1",
    "port" => 6379
));

$redis->publish('appEvent', json_encode((object) ['key' => 'Login', ['data' => ['time' => time()]]]));

header('Content-type: text/plain');
echo "Event published" . PHP_EOL;
