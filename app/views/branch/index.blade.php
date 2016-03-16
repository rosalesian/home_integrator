@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid gray;padding-bottom:10px;">Branch</h3>
{{ HTML::link('branch/create','New Branch', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px;')) }}
<table class="table table-hover table-striped" style="margin-top:10px;">
		<thead>
			<tr style="font-size: 12px;">
			<th></th>
			<th style="text-align:center;">Internal ID</th>
			<th style="text-align:center;">Branch Name</th>
			<th style="text-align:center;">Status</th>
			</tr>
		</thead>
		<tbody style="font-size: 12px; text-align:center;">
			@foreach($branches as $branch)
				<tr>
					<td>{{ HTML::link('branch/'.$branch->branch_id.'/edit','Edit') }}&nbsp;|&nbsp;
						{{ HTML::link('branch/'.$branch->branch_id,'View') }}
					</td>
					<td style="text-align:center">{{ $branch->branch_id }}</td>
					<td style="text-align:center">{{ $branch->branchname }}</td>
					<td style="text-align:center">{{ ($branch->inactive==1) ? 'Inactive' : 'Active' }}</td>								
				</tr>
			@endforeach
		</tbody>
		</table>
</div>
@endsection
