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

	<!-- ICON -->
  <link rel="shortcut icon" href="{{{ asset('integration_icon.png') }}}">

</head>
<body>
  @if(Auth::check() && Auth::user()['inactive']==0)
	  @include('layouts.nav')
	  @yield('content')
	  @include('layouts.footer')
  @else
  	{{ Redirect::to('/') }}
  @endif
	<!--JQUERY LIBRARY-->
	{{ HTML::script('bootstrap-3.3.2-dist/js/jquery-1.11.2.min.js') }}
	<!--BOOTSTRAP SCRIPTS-->
  {{ HTML::script('bootstrap-3.3.2-dist/js/modal.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/bootstrap.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/dropdown.js') }}
	{{ HTML::script('bootstrap-3.3.2-dist/js/npm.js') }}
	<!--CUSTOM SCRIPTS-->
	{{ HTML::script('scripts/custom_script.js') }}
	{{ HTML::script('scripts/validate_script.js') }}
</body>
</html>
