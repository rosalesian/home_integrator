<html>
<head>
	<title>{{ $title }}</title>
	<!--BOOTSTRAP CSS-->
	{{HTML::style('bootstrap-3.3.2-dist/css/bootstrap.css')}}
	{{HTML::style('bootstrap-3.3.2-dist/css/bootstrap.min.css')}}
	{{HTML::style('bootstrap-3.3.2-dist/css/bootstrap-theme.css')}}
	{{HTML::style('bootstrap-3.3.2-dist/css/bootstrap-theme.min.css')}}
	
	<!--CUSTOM CSS-->
	{{HTML::style('bootstrap-3.3.2-dist/css/custom.css')}}				
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="subBody">

		<div class="login-container">
				<div class="header"><span class="headerText">Register</span></div>
				<div class="logInCont">
					{{Form::open(array('action'=>'LoginController@postRegister','method'=>'post'))}}
					<div class="input-group custom-input-control">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('name','<p>:message</p>')}}</font>
					</div>
					
					<div class="input-group custom-input-control">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" id="email">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('username','<p>:message</p>')}}</font>
					</div>
					<div class="input-group custom-input-control">
						<label for="username">Email</label>
						<input type="text" name="email" class="form-control" id="email">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('email','<p>:message</p>')}}</font>
					</div>
					<div class="input-group custom-input-control">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" id="password">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('password','<p>:message</p>')}}</font>
					</div>
					<div class="custom-input-control">
						<button type="submit" name="btnSubmit" class="btn btn-warning custom-button-login">Sign Me Up</button>
					</div>
					{{Form::close()}}
				</div>
				<div class="footer">

				</div>
		</div>
</div>	
	<!--JQUERY LIBRARY-->
	{{ HTML::script('bootstrap-3.3.2-dist/js/jquery-1.11.2.min.js') }}
	<!--BOOTSTRAP SCRIPTS-->
  {{ HTML::script('bootstrap-3.3.2-dist/js/modal.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/bootstrap.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/dropdown.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/npm.js') }}
	<!--CUSTOM SCRIPTS-->
	{{ HTML::script('scripts/validate_script.js') }}
</body>
</html>


