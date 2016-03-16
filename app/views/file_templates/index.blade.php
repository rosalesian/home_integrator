@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid gray;padding-bottom:10px;">File Template</h3>
{{ HTML::link('filetemplate/create','New Template', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px;')) }}
<table class="table table-hover table-striped" style="margin-top:10px;">
		<thead>
			<tr style="font-size: 12px;">
			<th></th>
			<th style="text-align:center;">Internal ID</th>
			<th style="text-align:center;">File Name</th>
			<th style="text-align:center;">Status</th>
			</tr>
		</thead>	
		<tbody style="font-size: 12px; text-align:center;">
			@foreach($templates as $template)
				<tr>
					<td>{{ HTML::link('filetemplate/'.$template->template_id.'/edit','Edit') }}&nbsp;|&nbsp;
						{{ HTML::link('filetemplate/'.$template->template_id,'View') }}
					</td>
					<td style="text-align:center">{{ $template->template_id }}</td>
					<td style="text-align:center">{{ $template->filename }}</td>
					<td style="text-align:center">{{ ($template->inactive==1) ? 'Inactive' : 'Active' }}</td>								
				</tr>
			@endforeach
		</tbody>
		</table>
</div>
@endsection
