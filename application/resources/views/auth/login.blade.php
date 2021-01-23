<!doctype html>
<html lang="en">


<!-- Mirrored from thememakker.com/templates/hexabit/html/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Sep 2018 08:30:31 GMT -->
<head>
<title>LMS</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="HexaBit Bootstrap 4x Admin Template">
<meta name="author" content="WrapTheme, www.thememakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="SMS/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="SMS/assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="SMS/assets/css/main.css">
<link rel="stylesheet" href="SMS/assets/css/color_skins.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body class="theme-orange auth-main">
    
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-4 offset-md-4">
                    <div class="card" style="border-radius:0px;border:0px;">
                        <div>
                            <div>
                                <div class="header" style="background-color: white;border-top: 0px;">
                                    <center><img src="http://whitepaper.tech/wp-content/uploads/2017/12/logo.png" style="width:160px;"></center>
                                    <p class="lead" style="color:gray;">Login to your account</p>
                                </div>
                                <div class="body">
                                    <form method="POST" class="form-auth-small" action="{{ route('login') }}">
                                     @csrf
                                        <div class="form-group">
                                            <label for="signin-email" class="control-label" style="color:gray;">Email</label>   
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="signin-password" class="control-label" style="color:gray;">Password</label>
                                             <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif  
                                        </div>
                                        <div class="form-group clearfix">
                                            <label class="element-left" style="margin-left: 19px;">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span style="color:gray;font-size:13px;">Remember me</span>
                                            </label>
                                            <label class="fancy-checkbox element-right">
                                                <a  href="{{ route('password.request') }}" style="color:#4991b3;font-weight:bold;font-size:13px;">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </label>                                
                                        </div>
                                         <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 0px;">
                                            {{ __('Login') }}
                                        </button>
                                       
                                        <div class="bottom">
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
    
<script src="SMS/assets/bundles/libscripts.bundle.js"></script>    
<script src="SMS/assets/bundles/vendorscripts.bundle.js"></script>

<script src="SMS/assets/bundles/mainscripts.bundle.js"></script>
</body>

<!-- Mirrored from thememakker.com/templates/hexabit/html/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Sep 2018 08:30:31 GMT -->
</html>

