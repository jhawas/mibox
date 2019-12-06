var app = require("express")();

var server = require("http").Server(app);

var io = require("socket.io")(server);

var Redis = require("ioredis");

var redis = new Redis();

redis.psubscribe(["*"], function(err, count) {});

redis.on("pmessage", function(subscribe, channel, message) {
    console.log("message received");

    console.log("psubscribe: " + subscribe);
    console.log("pchannel: " + channel);
    console.log("pmessage: " + message);

    message = JSON.parse(message);

    io.emit(channel + ":" + message.event, message.data);
    io.emit(message.event, message.data);

});

server.listen(3000, function() {
    console.log("server run at port 3000 to stop ctr + c");
});

io.on("connection", function(socket) {
    console.log("a user connected");
    socket.on("disconnect", function() {
        console.log("user disconnected");
    });
});


