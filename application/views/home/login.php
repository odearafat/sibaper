<html>
<title>SIBAPER </title>
	<link rel="icon" href="<?=base_url()?>images/icon.ico">
<head>
</head>
<!-- Bootstrap -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.form-signin
		{
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
		}
		.form-signin .form-signin-heading, .form-signin .checkbox
		{
			margin-bottom: 10px;
		}
		.form-signin .checkbox
		{
			font-weight: normal;
		}
		.form-signin .form-control
		{
			position: relative;
			font-size: 16px;
			height: auto;
			padding: 10px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.form-signin .form-control:focus
		{
			z-index: 2;
		}
		.form-signin input[type="text"]
		{
			margin-bottom: -1px;
			border-bottom-left-radius: 0;
			border-bottom-right-radius: 0;
		}
		.form-signin input[type="password"]
		{
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
		.account-wall
		{
			margin-top: 20px;
			padding: 40px 0px 20px 0px;
			background-color: #f7f7f7;
			-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}
		.login-title
		{
			color: #555;
			font-size: 18px;
			font-weight: 400;
			display: block;
		}
		.profile-img
		{
			width: 96px;
			height: 96px;
			margin: 0 auto 10px;
			display: block;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
		}
		.need-help
		{
			margin-top: 10px;
		}
		.new-account
		{
			display: block;
			margin-top: 10px;
		}
	</style>
<body>
	<div class="container">
    <div style="padding-top:10%" class="rows">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
		<h1 class="text-center login-title">LOGIN SIBAPER</h1>
            <div class="account-wall">
                <img class="profile-img" src="<?=base_url()?>assets/images/login.png" alt="">
				<?php echo $valLogin?>
                <form class="form-signin" action="login" method="post">
                <input type="text" class="form-control" name="username" placeholder="username" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				<!-- <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>-->
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>