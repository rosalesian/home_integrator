@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562;">Roles</h3>
	<div class="row">
		{{ Form::open(array('action'=>'role.store','method'=>'post')) }}
		<div class="row" style="margin-left:30px;">
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">ROLE NAME</label>
					<input type="text" name="rolename" class="form-control" id="rolename" value="{{ Input::old('rolename') }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('rolename','<p>:message</p>')}}</font>
				</div>
			</div>
		</div>
		<div class="row" style="margin-left:30px;">
			<div class="col-md-4">
				{{ Form::submit('Save', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px;')) }}
				{{ HTML::link('role','Cancel', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
