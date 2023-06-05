<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
  margin: 0;
  padding: 0;
  background-color: #ffffff;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: auto;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form  {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link #login-alert{
  margin-top: -85px;
}

</style>
<body>

   
  

    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-4">
                 
                    <div id="login-box" class="col-md-12">
                      
                        <form id="login-form" class="form" action="{{route('login.check')}}" method="POST">
                            @if(session()->has('error'))
                            <div id="login-alert" class="alert alert-danger custom-alert col-md-12"><b>Warning!</b> {{session('error')}}</div>
                            @endif
                            @csrf
                            <h3 style="color: #0c4e68" class="text-center">HKI</h3>
                            <div class="form-group">
                                <label for="username" style="color: #0c4e68">Username</label><br>
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="form-group">
                                <label style="color: #0c4e68" for="password">Password</label><br>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="on" placeholder="Masukkan Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                            <div style="margin-bottom: 2em;background-color:#0c4e68;" class="form-group">
                                <input style="background-color: #0c4e68"  type="submit" name="submit" class="btn btn-info btn-md float-right" value="Login">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
{{-- <script type="text/javascript">

    $("document").ready(function()
    {
      setTimeout(function()
      {
        $("div.alert").slideup();
      }, 2000);
    });

  </script> --}}

<script> window.setTimeout(function() {
    $(".custom-alert").slideUp(2000, function() {
        $(this).remove();
    });
}, 2000);</script>
 