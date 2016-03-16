@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid gray;padding-bottom:10px;">Users</h3>
{{ HTML::link('user/create','New User', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px;')) }}
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
			@foreach($users as $user)
			<tr>
				<td><a href="user/{{ $user->id }}/edit">Edit</a>&nbsp;|&nbsp;<a href="user/{{ $user->id }}">View</a></td>
				<td>{{ $user->id }}</td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->role[0]->rolename }}</td>
				<td>{{ ($user->inactive==1) ? 'Inactive' : 'Active' }}</td>
				<td>{{ ($user->branch_id==0	) ? '' : $user->branch[0]->branchname }}</td>
			</tr>	
			@endforeach
		</tbody>
		</table>
</div>
@endsection
