var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '/index.html');
});

io.on('connection', function(socket){
    var username;

    socket.on('chat message', function(msg){
        console.log(msg);
        io.emit('chat message', msg);
    });

    socket.on('first message', function(msg){
        console.log(msg);
        username = msg.username;
        io.emit('first message', msg);
    })

    socket.on('disconnect', function(){
        console.log(username+'disconnected');
        io.emit('disconnect', {username: username})
    });

});

http.listen(3000, function(){
    console.log('listening on *:3000');
});
