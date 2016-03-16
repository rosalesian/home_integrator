@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562; margin-bottom:0px;">Branch</h3>
	
		@if(Session::has('message'))
		<div class="alert alert-success alert-dismissible" role="alert" style="width:98%; padding:10px; margin:10px 0px 0px 15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right:20px;"><span aria-hidden="true">&times;</span></button>
			{{Session::get('message')}}
		</div>
		@endif
{{ Form::open(array('url'=>'branch/'.$branch->branch_id,'method'=>'put')) }}
	<div class="row" style="margin-top:40px;">
		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">BRANCH NAME</label>
					<input type="text" name="branchname" class="form-control" id="branchname" value="{{ $branch->branchname }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('branchname','<p>:message</p>')}}</font>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group custom-input-control">
				<label for="inactive_status">INACTIVE</label><br/>
				@if($branch->inactive==1)
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;"checked>
				@else
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;">
				@endif
				</div>
			</div>
		</div>
		<div class="row" style="margin-left:30px;">
			<div class="col-md-4">
				{{ Form::submit('Save', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px;')) }}
				{{ HTML::link('branch/'.$branch->branch_id,'Cancel', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
			</div>
		</div>
	</div>
{{ Form::close() }}
</div>
@endsection
