var app = require('express')
var http = require('http').Server(app)
var io = require('socket.io')(http)
var mysql = require('mysql')
var env = require('dotenv').config({path: '../.env'}).parsed;

var connection = mysql.createConnection({
    host     : env.DB_HOST,
    user     : env.DB_USERNAME,
    password : env.DB_PASSWORD,
    database : env.DB_DATABASE
});

// INSERT INTO `chat`(`id`, `user_id`, `is_panitia`, `expo_id`, `chat`, `date`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])

connection.connect(function(err) {
    if(err) return console.log("DB Error")
    console.log("db ok!")

    io.on('connection', function(socket){
        var id_user, expo_id;

        socket.on('panitia', function(msg){
            console.log(msg);

            expo_id = msg.expo_id
            if(msg.expo_id == expo_id){
                var chat  = {user_id: msg.user_id, is_panitia: 1, expo_id: expo_id, chat: msg.chat, date: '-'}
                connection.query('INSERT INTO `chat` set ?', chat, function(err, result) {
                    msg.date = Date()
                    io.emit('chat message panitia', msg);
                });
            }
        });

        socket.on('peserta', function(msg){
            console.log(msg);

            expo_id = msg.expo_id
            if(msg.expo_id == expo_id){
                var chat  = {user_id: msg.user_id, is_panitia: 0, expo_id: expo_id, chat: msg.chat, date: '-'}
                connection.query('INSERT INTO `chat` set ?', chat, function(err, result) {
                    console.log(err)
                    io.emit('chat message peserta', msg);
                });
            }
        });
    });

    http.listen(3000, function(){
        console.log('listening on *:3000');
    });
});



