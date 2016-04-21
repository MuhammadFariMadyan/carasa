<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Login</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{asset('css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <div class="progress">
    <div class="determinate" style="width: 70%"></div>
  </div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h2 class="header center">
        <img class="responsive-img" src="img/carasa9.png">
      </h2>
      <div class="row center">
        <a class="grey-text">Sign in to start your session</a>
      </div>
          @yield('content')
        </div>
        <div class="modal-footer">
          <button class="modal-action modal-close btn waves-effect waves-light" type="submit" name="action">Send
              <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
    </div>
  </div>          

  <br><br>
  
  <div class="progress">
    <div class="determinate" style="width: 70%"></div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{asset('js/materialize.js')}}"></script>
  <script src="{{asset('js/init.js')}}"></script>
  <script>
     $(document).ready(function(){
      // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
      $('.modal-trigger').leanModal();
      $('#modal1').openModal();
      $('#modal1').closeModal();
  });
  </script>

</body>
</html>
