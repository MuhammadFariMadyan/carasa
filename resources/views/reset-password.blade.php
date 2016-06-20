<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Reset Password</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <div class="progress">
    <div class="determinate" style="width: 70%"></div>
  </div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h2 class="header center">
        <img class="responsive-img" src="{{asset('/img/carasa9.png')}}">
      </h2>
      <div class="row center">
        <a class="grey-text">Reset your password</a>
      </div>
      <form method="POST" action="/password/reset">

        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="row">
          <div class="input-field col s6 push-s3">
            <i class="small material-icons prefix">email</i>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 push-s3">
            <i class="small material-icons prefix">vpn_key</i>
            <input id="password" type="password" name="password" class="validate">
            <label for="password">New password </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 push-s3">
            <i class="small material-icons prefix">vpn_key</i>
            <input id="password" type="password" name="password_confirmation" class="validate">
            <label for="password">Retype your new password </label>
          </div>
        </div>
        <div class="row center">
          <button class="btn waves-effect waves-light" type="submit" name="action">Save & Login
              <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <br><br><br><br>
  
  <div class="progress">
    <div class="determinate" style="width: 70%"></div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{ asset('js/materialize.js') }}"></script>
  <script src="{{ asset('js/init.js') }}"></script>

  </body>
</html>
