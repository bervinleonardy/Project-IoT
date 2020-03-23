<!DOCTYPE html>
<html>	
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UPTAM Cimahi | Log In</title>
  <link rel='shortcut icon' type='image/x-icon' href='img/cimahi_logo_icon.ico' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="content/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="content/dist/css/login.css">
  <!-- iCheck -->
<!--  <link rel="stylesheet" href="content/plugins/icheck-bootstrap/icheck-bootstrap.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.2 -->	
<!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>	-->
<!-- jQuery 2.2.3 -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>		
  <!-- Hide Password -->	
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>
<style type="text/css">
	body {
    background: url('content/dist/img/frontend.jpg')no-repeat center center fixed;
   -webkit-background-size: 100% 100%;
   -moz-background-size: 100% 100%;
   -o-background-size: 100% 100%;
   background-size: 100% 100%;
}
	
/*
body:before {
  content: "";
  position: fixed;
  z-index: -1;
  background-size:cover;
  background-position:center top;
  display: block;
  background-image: url(content/dist/img/front.JPG);
  width: 100%;
  height: 400px;
  filter: blur(5px) ;
  -webkit-filter: blur(5px) ;
}
*/
h1 {
/*  font-size:30px;*/
  color:#fff;
/*
  font-weight:bold;
  border:5px #fff solid;
  display:inline-block;
  padding:5px 20px
*/
}	
#password + .glyphicon {
  cursor: pointer;
  pointer-events: all;
}	
</style>
  
</head>
<body class="hold-transition ">
<div class="login-box">
  <div class="login-logo">
    <h1><b>Portal WLDS</b><br>UPT Air Minum</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat Datang Silakan Log In</p>
    <form action="lib/login.php?log=<?=md5('login') ?>" method="POST">
      <div class="form-group has-feedback">
        <input type="username" name="username" id="username" class="form-control" placeholder="NIP or Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <i class="glyphicon glyphicon-eye-open form-control-feedback"></i>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
<!--
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block " value="Login">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

<!--    <a href="#">I forgot my password</a><br>-->
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Bootstrap 3.3.6 -->
<!--<script src="content/bootstrap/js/bootstrap.min.js"></script>-->
<!-- iCheck -->
<!--<script src="content/plugins/iCheck/icheck.min.js"></script>-->
	<script type="text/javascript"> 
	// toggle password visibility
	$('#password + .glyphicon').on('click', function() {
	  $(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open'); // toggle our classes for the eye icon
	  $('#password').togglePassword(); // activate the hideShowPassword plugin
	});		
	</script>	
<!--
<script>	
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
-->
</body>
</html>

	