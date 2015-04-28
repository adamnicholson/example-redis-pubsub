# Example PHP/NodeJS/Redis PubSub

Install dependencies

```
npm install && composer install
```

Start a node webserver to handle socket connections

```
node socket.js
```

Start the queue runner service

```
php queue.php
```

Start a PHP webserver, which is where our client lives

```
php -S localhost:8000
```

Look at it:

- Load the client in a browser: `http://localhost:8000/index.html`
- Publish an event straight to the client `http://localhost:8000/commands/announce-login.php`
- Queue a slow command to be run by the queue.php service, which will then emit an event to the client when it's finished (5 seconds) `http://localhost:8000/commands/announce-login.php`

