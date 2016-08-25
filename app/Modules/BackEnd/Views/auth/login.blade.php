<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page</title>
    <!-- Bootstrap -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('css/nprogress.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal" role="form" method="POST" action="{{URL::route('BackEndAuth.postLogin')}}">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <h1>Laravel</h1>
              <h5 class="semibold mt-5 text-white">Login to your account.</h5>

              @if ( count($errors) > 0 )
                <div style="text-align: justify">
                  @foreach ($errors->all() as $error)
                    <div style="color:red;"><strong>{{ $error }}</strong></div>
                  @endforeach
                </div>
              @endif

              <div>
                <input id="Username" type="text" class="form-control" placeholder="Username" required="" name="UserName"/>
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-sign-in"></i> Login
                </button>

                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>