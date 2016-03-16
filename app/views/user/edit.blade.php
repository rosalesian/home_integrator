@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562; margin-bottom:0px;">Users</h3>
{{ Form::open(array('url'=>'user/'.$user->id,'method'=>'put','style'=>'margin-top:40px;')) }}
	<div class="row">
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="name">NAME</label>
				<input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
				<font style="font-size: 10px; color:#770404;">{{ $errors->first('name','<p>:message</p>')}}</font>
			</div>
		</div>
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="username">USERNAME</label>
				<input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}">
				<font style="font-size: 10px; color:#770404;">{{ $errors->first('username','<p>:message</p>')}}</font>
			</div>
		</div>
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="branchname">BRANCH</label>
				<select class="form-control" name="branchname" id="branchname">
					@foreach($branches as $branch)
						@if($user->branch_id==$branch->branch_id)
							<option value="{{ $branch->branch_id }}" selected>{{ $branch->branchname }}</option>
						@else
							<option value="{{ $branch->branch_id }}">{{ $branch->branchname }}</option>
						@endif	
					@endforeach
				</select>
			</div>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="branchname">NETSUITE ROLE</label>
				<select class="form-control" name="netsuite_role" id="netsuite_role">
						<option value="3">Administrator</option>
						<option value="1063">BO-in-charge</option>
						<option value="1089">Encoder</option>
						<option value="1028">Invoicing Clerk</option>
						<option value="1092">PO In-Charge</option>
						<option value="1045">Warehouse Custodian</option>
				</select>
			</div>
			<div class="input-group custom-input-control">
				<label for="active_status">INACTIVE</label><br/>
				@if($user->inactive==1)
				<input type="checkbox" name="inactive_status" id="active_status" style="width:20px; height:20px;" checked>
				@else
				<input type="checkbox" name="inactive_status" id="active_status" style="width:20px; height:20px;">
				@endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="email">EMAIL</label>
				<input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
				<font style="font-size: 10px; color:#770404;">{{ $errors->first('email','<p>:message</p>')}}</font>
			</div>
		</div>
		<div class="col-md-4">
			<div class="input-group custom-input-control">
				<label for="rolename">ROLE</label>
				<select class="form-control" class="rolename" id="rolename" name="rolename">
					@foreach($roles as $role)
						@if($user->role_id==$role->role_id)
							<option value="{{ $role->role_id }}" selected>{{ $role->rolename }}</option>
						@else
							<option value="{{ $role->role_id }}">{{ $role->rolename }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>	
	</div>
		
	<div class="row">
		<div class="col-md-4">
				{{ Form::submit('Save', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px;')) }}
			{{ HTML::link('user/'.$user->id,'Cancel', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}		
		</div>
	</div>
	{{ Form::close() }}
	</div>
@endsection
