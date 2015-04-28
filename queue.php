<?php

require __DIR__ . '/bootstrap.php';

function fire($job)
{
    $client = new Predis\Client(array(
        "scheme" => "tcp",
        "host" => "127.0.0.1",
        "port" => 6379
    ));

    if ($job instanceof LaunchMissilesCommand) {
        sleep(5); // Takes a long time to launch a missile
        $client->publish('appEvent', json_encode((object) ['key' => 'Missile launched', ['data' => ['time' => time()]]]));
    }
}

$client = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "127.0.0.1",
    "port" => 6379
));

$pubsub = $client->pubSubLoop();
$pubsub->subscribe('queue');

foreach ($pubsub as $message) {
    switch ($message->kind) {

        case 'subscribe':
            echo "Subscribed to {$message->channel}", PHP_EOL;
            break;

        case 'message':
            if ($message->channel == 'control_channel') {
                if ($message->payload == 'quit_loop') {
                    echo "Aborting pubsub loop...", PHP_EOL;
                    $pubsub->unsubscribe();
                } else {
                    echo "Received an unrecognized command: {$message->payload}.", PHP_EOL;
                }
            } else {
                echo "Processing the following message from {$message->channel}:",
                PHP_EOL, "  {$message->payload}", PHP_EOL, PHP_EOL;
                fire(unserialize($message->payload));
            }
            break;
    }
}

// Always unset the pubsub consumer instance when you are done! The
// class destructor will take care of cleanups and prevent protocol
// desynchronizations between the client and the server.
unset($pubsub);
// Say goodbye :-)
$version = redis_version($client->info());
echo "Goodbye from Redis $version!", PHP_EOL;
