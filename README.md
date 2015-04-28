# Example PHP/NodeJS/Redis PubSub

Install dependencies

```
npm install && composer install
```

Start a node webserver to handle socket connections on port `3000`

```
node socket.js
```

Start the queue runner service, listening for redis events and emitting messages when commands are ran

```
php queue.php
```

Start a PHP webserver on port `8000`, which is where our client lives

```
php -S localhost:8000
```

Look at it:

- Load the client in a browser: `http://localhost:8000/index.html`
- Publish an event straight to the client `http://localhost:8000/commands/announce-login.php`
- Queue a slow command to be run by the queue.php service, which will then emit an event to the client when it's finished (5 seconds) `http://localhost:8000/commands/announce-login.php`

