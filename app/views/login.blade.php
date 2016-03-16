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
<!--MODAL-->
  <div class="modal" id="modalResetPassword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  	{{ Form::open(array('url'=>'reset_request','method'=>'post','id'=>'formRequestReset')) }}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Request to Reset Password</h4>
      </div>
      <div id="messageContainer" role="alert" style="font-size: 12px; width:95%; margin:auto; margin-top:2%; padding:5px;"></div>
      <div class="modal-body">
          <div class="form-group">
            <label for="message-text" class="control-label">Username</label>
            <input type="text" class="form-control" name="username_request" id="username_request">
            <span id="containerValidationUsernameRequestReset"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" value="Send Request">
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div><!-- /.END MODAL-->

<div class="subBody">
		<div class="login-container">
				<div class="header"><span class="headerText">Sign In</span></div>
				<div class="logInCont">
					{{Form::open(array('action'=>'LoginController@postLogin','method'=>'post'))}}
					@if(Session::has('message'))
					<font style="font-size:10px; color:red; margin-left:12px;">{{Session::get('message')}}</font>
					@endif
					<div class="input-group custom-input-control">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" id="email">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('username','<p>:message</p>')}}</font>
					</div>
					<div class="input-group custom-input-control">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control"id="password">
						<font style="font-size: 10px; color:#770404;">{{ $errors->first('password','<p>:message</p>')}}</font>
					</div>
					<div class="checkbox custom-input-control">
						<label>
						<input type="checkbox" style="width:15px; height:15px;" name="rememberme"> Remember Me
						</label>
					</div>
					<div class="custom-input-control">
						<button type="submit" name="btnSubmit" class="btn btn-info custom-button-login">Sign Me In</button>
					</div>
					{{Form::close()}}
				</div>
				<div class="footer">
						<a href="#" data-toggle="modal" data-target="#modalResetPassword">Send Request to Reset Password</a>
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

