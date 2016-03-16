@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid gray;padding-bottom:10px;">Roles</h3>
{{ HTML::link('role/create','New Role', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px;')) }}
<table class="table table-hover table-striped" style="margin-top:10px;">
		<thead>
			<tr style="font-size: 12px;">
			<th></th>
			<th style="text-align:center;">Internal ID</th>
			<th style="text-align:center;">Role Name</th>
			<th style="text-align:center;">Status</th>
			</tr>
		</thead>
		<tbody style="font-size: 12px; text-align:center;">
			@foreach($roles as $role)
				<tr>
					<td>{{ HTML::link('role/'.$role->role_id.'/edit','Edit') }}&nbsp;|&nbsp;{{ HTML::link('role/'.$role->role_id,'View') }}</td>
					<td style="text-align:center">{{ $role->role_id }}</td>
					<td style="text-align:center">{{ $role->rolename }}</td>
					<td style="text-align:center">{{ ($role->inactive==1) ? 'Inactive' : 'Active' }}</td>								
				</tr>
			@endforeach
		</tbody>
		</table>
</div>
@endsection
