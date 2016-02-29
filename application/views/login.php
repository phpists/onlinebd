<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Авторизация</title>
		<!-- Bootstrap -->
		<link href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
		<script src="<? echo base_url() ?>application/views/js/jquery.js"></script>  
		<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap.min.js"></script>  
	


<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
}

.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin .checkbox {
	font-weight: normal;
}
.form-signin .form-control {
	position: relative;
	font-size: 16px;
	height: auto;
	padding: 10px;
	-webkit-box-sizing: border-box;
		 -moz-box-sizing: border-box;
					box-sizing: border-box;
}
.form-signin .form-control:focus {
	z-index: 2;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
	margin-bottom: 10px;
}
.form-signin label {
		font-weight: normal;
}
.error {
				 color: #b94a48;      
}

.form-signin {
		background-color: #fff;
		border: 1px solid #e5e5e5;
		border-radius: 5px;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
		margin: 0 auto 20px;
		max-width: 400px;
		padding: 19px 29px 29px;
}
</style>
	
	

<div class="container">
				 <form class="form-signin" method="post" action="<? echo site_url("main/index") ?>" id="form-signin">
						<center><h2 class="form-signin-heading">Авторизация</h2></center>
						<div class="control-group">
							 <label class="control-label" for="login">Почта:</label>
							 <div class="controls">
									<input size="50" name="login" id="login" value="" type="text" class="form-control" placeholder="e-mail" required="required">
							 </div>
						</div>						
						<div class="control-group" id="block_pass">
							 <label class="control-label" for="password">Пароль:</label>
							 <div class="controls">
									<input size="50" name="password" id="password" type="password" class="form-control" placeholder="Password">
							 </div>
						</div>
						<button  name="submit" id="submit" value="" type="submit" class="btn btn-large btn-success btn-block">Войти</button>
			<? if($message) { ?>
				<br>
				<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<? echo $message ?>
				</div>
			<? } ?>

				 </form>
</div>
	
	
	

	
	
	
</body>
</html>