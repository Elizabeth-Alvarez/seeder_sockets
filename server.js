var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


  var users = [];
  var words = [];
  var nums = 0
  var all_messages = [];
  var blocked_words = [];

  io.on('connection', function (socket) {
    console.log('socket connected', socket.id);


  socket.on('store_users',function(data){
   if(nums == 0){
    nums += 1;
   for(var i = 0; i < data.users.length; i++){
    // console.log(data.users[i]['name']);
    users.push(data.users[i]['full_name']);
   }
   socket.emit('users_stored', {data: "success"});

  }else{
   socket.emit('show_messages',{messages:all_messages});
   socket.emit('send_blocked_words', {blocked_words: blocked_words});
  }
  });


  socket.on('store_words',function(data){
   // console.log('all users' , data.users);
   for(var i = 0; i < data.words.length; i++){
    // console.log(data.users[i]['name']);
    words.push(data.words[i]['word']);
   }
   start_interval();
  });

  socket.on('store_blocked_words', function(data){
   // console.log(data.blocked_words);
   for(var i = 0; i < data.blocked_words.length; i++){
    blocked_words.push(data.blocked_words[i]['word']);
   }
  //  console.log('words man', blocked_words);
  })


  function start_interval(){
   var message_position = 1;

   setInterval(function(){
    var client_messages = [];

    for(var i = 0; i < 500; i++){
     var word = get_word();
     client_messages.push({
      name: users[Math.floor(Math.random() * users.length) + 1 - 1],
      word: word,
      message_position: message_position
     });
      message_position += 1;
    }

    for(var i = 0; i < client_messages.length; i++){
     all_messages.push(client_messages[i]);
    }

    io.emit('show_messages', {messages: client_messages});
   }, 5000);

 };

 function get_word(){
  var check = true;
  var word_to_check = null;
  while(check == true){
   check = false;
   word_to_check =  words[Math.floor(Math.random() * words.length) + 1 - 1];
   for(var i = 0; i < blocked_words.length; i++){
    if(word_to_check == blocked_words[i]){
     check = true;
    }
   }
  }
  return word_to_check;
 }

});
