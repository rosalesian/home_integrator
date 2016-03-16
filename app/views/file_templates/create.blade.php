@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562;">File Template</h3>
	<div class="row">
		{{ Form::open(array('action'=>'filetemplate.store','method'=>'post')) }}
		<div class="row" style="margin-left:30px;">
			
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">FILENAME</label>
					<input type="text" name="filename" class="form-control" id="filename" value="{{ Input::old('filename') }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('filename','<p>:message</p>')}}</font>
				</div>
			</div>

			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">HEADER</label>
					<input type="text" name="headername" class="form-control" id="headername" value="{{ Input::old('headername') }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('headername','<p>:message</p>')}}</font>
				</div>

				<div class="input-group custom-input-control">
					<a href="#" class="btn btn-info" id="btnAddHeader">Add Header</a>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<div id="header-container" style="background-color:#fff; border-radius: 5px; height: 200px; width:340px; overflow:scroll;">
						<ul style="list-style:none; font-size: 16px;">
						</ul>
					</div>
					<font style="font-size: 10px; color:#770404;">{{ Session::get('headersMessage') }}</font>
				</div>
			</div>
		</div>
		<div class="row" style="margin-left:30px;">
			<div class="col-md-4">
				{{ Form::submit('Save', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px;')) }}
				{{ HTML::link('filetemplate','Cancel', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
