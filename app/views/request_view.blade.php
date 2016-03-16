@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid gray;padding-bottom:10px;">Reset Password Requests</h3>
@if(Session::has('message'))
		<div class="alert alert-success alert-dismissible" role="alert" style="width:98%; padding:10px; margin:10px 0px 0px 15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right:20px;"><span aria-hidden="true">&times;</span></button>
			{{Session::get('message')}}
		</div>
@endif
<table class="table table-hover table-striped" style="margin-top:10px;">
		<thead>
			<tr style="font-size: 12px;">
			<th></th>
			<th style="text-align:center;">Internal ID</th>
			<th style="text-align:center;">Username</th>
			<th style="text-align:center;">Name</th>
			<th style="text-align:center;">Email</th>
			<th style="text-align:center;">Role</th>
			<th style="text-align:center;">Status</th>
			<th style="text-align:center;">Branch</th>
			</tr>
		</thead>
		<tbody style="font-size: 12px; text-align:center;">
			@if(count($requests)==0)
			<tr>
				<td colspan="8">No records Found</td>
			</tr>
			@else
				@foreach($requests as $request)
				<tr>
					<td><a href="#" data-toggle="modal" data-target="#modalResetPassword" class="btnResetPasswordRequested" id="{{ $request->id }}">Reset</a></td>
					<td>{{ $request->id }}</td>
					<td>{{ $request->username }}</td>
					<td>{{ $request->name }}</td>
					<td>{{ $request->email }}</td>
					<td>{{ $request->role[0]->rolename }}</td>
					<td>{{ ($request->inactive==1) ? 'Inactive' : 'Active' }}</td>
					<td>{{ $request->branch[0]->branchname }}</td>
				</tr>
				@endforeach
			@endif	
		</tbody>
		</table>
</div>
<!--MODAL-->
<div class="modal" id="modalResetPassword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">Reset Password</h4>
  </div>
	{{ Form::open(array('url'=>'resetPassword','method'=>'post')) }}
  <div class="modal-body">
  		<input type="hidden" name="userid" id="userid">
      <div class="form-group">
        <label for="message-text" class="control-label">New Password:</label>
        <input type="password" class="form-control" name="newPass" id="newPass"	>
      </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-warning" value="Save">
  </div>
  {{Form::close()}}
</div>
</div>
</div><!-- /.END MODAL-->
@endsection
