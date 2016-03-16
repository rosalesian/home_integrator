@extends('layouts.default')
@section('content')
	<div class="formContainer">
	<h1>Upload Customer</h1>
	{{ Form::open(array('files'=>true, 'id'=>'formUploadCustomer')) }}
	{{ Form::file('uploadCustomerCSVFile') }}
	{{ Form::submit('Upload') }}
	{{ Form::close() }}

	@if(Session::has('message'))
	<p style="color:red;">{{ Session::get('message') }}</p>
	@elseif(Session::has('success'))
	<p style="color:green;">{{ Session::get('success') }}</p>
	@elseif(Session::has('fail'))
	<p style="color:red;">{{ Session::get('fail') }}</p>
	@endif
	</div>

	<span id="remarks"></span><br/>
	{{ HTML::link('validation/customers/download','download customer result',array('id'=>'downloadLink')) }}
	{{ HTML::image('ajax-loader.gif','loading', array('id'=>'loading')) }}
@endsection