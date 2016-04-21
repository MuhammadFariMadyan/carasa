<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Reset Password</title>

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
        <a class="grey-text">Reset your password</a>
      </div>
    <form>
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">vpn_key</i>
          <input id="password" type="password" class="validate">
          <label for="password">New password </label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">vpn_key</i>
          <input id="password" type="password" class="validate">
          <label for="password">Retype your new password </label>
        </div>
      </div>
    </form>
      <div class="row center">
        <button class="btn waves-effect waves-light" type="submit" name="action">Save & Login
            <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
  </div>

  <br><br><br><br>
  
  <div class="progress">
    <div class="determinate" style="width: 70%"></div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
