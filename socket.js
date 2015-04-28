// Socket
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

// Redis
var redis = require('redis');
var redisClient = redis.createClient(6379, '127.0.0.1', {});

// Socket handler
http.listen(3000, function(){
    //
});
io.on('connection', function(socket){
    //
});

// Redis subscriber/emitter
redisClient.on('message', function (channel, message) {
    io.emit(channel, JSON.parse(message));
});

redisClient.subscribe('appEvent');
