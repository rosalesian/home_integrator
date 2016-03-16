@extends('layouts.default')
@section('content')
	<div class="integration-container">
		<div class="row">
  		<div class="col-md-12">
  			<div class="log-container">
  				<input type="date" id="dateLog" style="margin: 2% 0% 2% 1%; border-radius:2px; width:21.3%">
		  		<input type="text" id="searchLogs" placeholder=" search uploaded items by customer code" style="padding: 8px 0px 8px 0px; margin: 2% 0% 2% 1%; border-radius:2px; width:75.5%;">
		  		<div class="transLogTable">
			  		<table class="table table-hover table-striped" style="box-shadow: 1px 1px 2px 2px #888888;">
			  		<thead>
			  			<tr style="font-size: 12px;">
                <th></th>
			  				<th>External ID</th>
                <th>Record ID</th>
			  				<th>Customer Code</th>
                <th>Account</th>
                <th>Department</th>
                <th>Principal</th>
                <th>Location</th>
                <th>Operation</th>
                <th>Date</th>
			  			</tr>
			  		</thead>
			  		<tbody id="result-container">
			  			{{-- {{dd($invoices)}} --}}
			  			@foreach($invoices as $key=>$val)
			  			<tr>
				  			<td><a href="'.Config::get('netsuite.invoice').$value->record_internal_id.'">view</a></td>
				  			<td>{{ $val->external_id }}</td>
				  			<td>{{ $val->record_internal_id }}</td>
				  			<td>{{ $val->customer }}</td>
				  			<td>{{ $val->account }}</td>
				  			<td>{{ $val->department }}</td>
				  			<td>{{ $val->principal }}</td>
				  			<td>{{ $val->location }}</td>
				  			<td>{{ $val->operation }}</td>
				  			<td>{{ $val->record_date }}</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  		</table>
		  		</div>
	  		</div>
  		</div>
	</div>
</div>
@endsection