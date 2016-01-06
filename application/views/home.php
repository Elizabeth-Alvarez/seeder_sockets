<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Example Page</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- Script for running sockets -->
  <script src="/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){

   var socket = io.connect( 'http://'+window.location.hostname+':3000' );

   $.get('/index.php/welcome/users', function(res){
    // console.log('my response', res);
    socket.emit('store_users', {users:res});
   }, 'json');


   socket.on('users_stored', function(data){

    $.get('/index.php/welcome/blocked_words', function(res){
    //  console.log('blocked' , res);
     socket.emit('store_blocked_words', {blocked_words:res});

     for(var i = 0; i < res.length; i++){
      $("#blocked_words").append("<tr><td>"+ res[i]['id'] +"</td><td>"+ res[i]['word']+"</td></tr>")
     }
    }, 'json');

    $.get('/index.php/welcome/words', function(res){
     socket.emit('store_words', {words:res});
    }, 'json');
   });

   socket.on('send_blocked_words',function(data){
    for(var i = 0; i < data.blocked_words.length; i++){
     $("#blocked_words").append("<tr><td>"+ (i + 1) +"</td><td>"+ data.blocked_words[i]+"</td></tr>")
    }
   })

   socket.on('show_messages', function(data){
    // console.log(data.messages);
    for(var i = 0; i < data.messages.length; i++){
     $('#show_data').append("<tr><td>"+ data.messages[i]['name'] +"</td><td>"+ data.messages[i]['word']+"</td><td>"+data.messages[i]['message_position']+"</td></tr>");
    }
   });

  })
  </script>
 </head>
 <body>
  <nav class="navbar navbar-default">
     <div class="container-fluid">
       <!-- Brand and toggle get grouped for better mobile display -->
       <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">CodeIgniter Chat App</a>
       </div>
     </div><!-- End of fluid container -->
   </nav>
   
  <div class='container'>
   <div class='row'>
    <div class='col-md-5' style='overflow:scroll; height: 500px; border: 2px solid black'>
     <h3>Random Users (Scroll to see more)</h3>
     <table class="table table-striped">
         <thead>
           <tr>
             <th>Name</th>
             <th>Message</th>
             <th>Message Position</th>
           </tr>
         </thead>
         <tbody id='show_data'></tbody>
       </table>
    </div>

    <div class='col-md-4 col-md-offset-2 text-center' style='overflow:scroll; height: 500px; border: 2px solid black'>
     <h3>Blocked Words</h3>
     <p>None of these words will show in left message board</p>
     <table class="table table-striped text-center">
         <thead>
           <tr>
             <th>ID</th>
             <th>Word</th>
           </tr>
         </thead>
         <tbody id='blocked_words'></tbody>
       </table>
    </div>
    </div>
  </div>
 </body>
</html>
