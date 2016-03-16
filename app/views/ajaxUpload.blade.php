@extends('layouts.default')
@section('content')
	<h1>AJAX Upload</h1>
	{{ Form::open(array('url'=>'validation/ajax/upload','method'=>'POST','files'=>true, 'id'=>'formUpload')) }}
	{{ Form::file('csvFile', array('id'=>'csvFile')) }}
	{{ Form::submit('Upload') }}
	{{ Form::close() }}
	<!--{{ HTML::image('ajax-loader.gif','loading', array('id'=>'loading')) }}-->
@endsection