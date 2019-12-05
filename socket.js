var server = require("http").Server();

var io = require("socket.io")(server);

var Redis = require("ioredis");
var redis = new Redis();

redis.subscribe("test-channel");

redis.on("message", function(channel, message) {
    message = JSON.parse(message);

    io.emit(channel + ":" + message.event, message.data);
    
    console.log(message);
});

server.listen(3000);

io.on("connection", function(socket) {
    console.log("connected");
    socket.on("disconnect", function() {
        console.log("disconnected");
    });
});

// var app = require("express")();

// var server = require("http").Server(app);

// var io = require("socket.io")(server);

// var Redis = require("ioredis");

// var redis = new Redis();

// redis.psubscribe(["*"], function(err, count) {});

// redis.subscribe(["*"], function(err, count) {});

// redis.on("pmessage", function(subscribe, channel, message) {
//     console.log("message received");

//     console.log("subscribe: " + subscribe);
//     console.log("channel: " + channel);
//     console.log("message: " + message);

//     message = JSON.parse(message);

//     io.emit(channel + ":" + message.event, message.data);
// });

// server.listen(3000, function() {
//     console.log("server run at port 3000 to stop ctr + c");
// });

// io.on("connection", function(socket) {
//     console.log("a user connected");
//     socket.on("disconnect", function() {
//         console.log("user disconnected");
//     });
// });


