<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Login</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
        <a class="grey-text">Sign in to strart your session</a>
      </div>
    <form>
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">email</i>
          <input id="email" type="email" class="validate">
          <label for="email">Email </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">vpn_key</i>
          <input id="password" type="password" class="validate">
          <label for="password">Password </label>
        </div>
      </div>
    </form>
      <div class="row center">
        <button class="btn waves-effect waves-light" type="submit" name="action">Sign in
            <i class="material-icons right">send</i>
        </button>
      </div>

      <!-- Modal Trigger -->
      <div class="row center">
        <a class="red-text modal-trigger" href="#modal1">I forgot my password</a>
      </div>

      <!-- Modal Structure -->
      <div id="modal1" class="modal">
        <div class="modal-content">
          <h4 class="red-text">Forgot Password</h4>
          <p>Kami akan mengirimkan link untuk pergantian password ke email anda. 
            <br> Masukkan email anda di bawah ini.</p>
            <br>
            <form>
              <div class="row">
                <div class="input-field col s6 push-s3">
                  <i class="small material-icons prefix">email</i>
                  <input id="email" type="email" class="validate">
                  <label for="email">Email </label>
                </div>
              </div>
            </form>
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
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
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
