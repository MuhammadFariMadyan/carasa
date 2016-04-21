 @extends('master.admin')
 @section('content')
 <form action="{{route('postlogin')}}" method="POST">
    {!! csrf_field() !!}
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">email</i>
          <input type = "text" name="username" class="validate" placeholder="Username">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 push-s3">
          <i class="small material-icons prefix">vpn_key</i>
          <input type="password" name="password" class="validate" placeholder="Password">
        </div>
      </div>
        <div class="row center">
        <button class="btn waves-effect waves-light" type="submit" name="action">Sign in
            <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
    

      <!-- Modal Trigger -->
      <div class="row center">
        <a class="red-text modal-trigger" href="{{route('getemail')}}">I forgot my password</a>
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
                  <input name="email" type="email" class="validate">
                </div>
              </div>
            </form>
@endsection