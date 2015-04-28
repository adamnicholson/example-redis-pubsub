# Example PHP/NodeJS/Redis PubSub

Install dependencies

```
npm install && composer install
```

Start node webserver

```
node socket.js
```

Start PHP webserver

```
php -S localhost:8000
```

Load the client in a browser: `http://localhost:8000/index.php`

Publish an event `wget http://localhost:8000/publisher.php`

