<?php

require __DIR__ . '/../../bootstrap.php';

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "127.0.0.1",
    "port" => 6379
));

$redis->publish('queue', serialize(new LaunchMissilesCommand()));

header('Content-type: text/plain');
echo "Launch queued" . PHP_EOL;
