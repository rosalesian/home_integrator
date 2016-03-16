@extends('layouts.default')
@section('content')
	<div class="integration-container">
		<div class="row">
  		<div class="col-md-12">
  			<div class="log-container">
  				{{-- <input type="date" id="dateIRA" style="margin: 2% 0% 2% 1%; width:21.3%"> --}}
		  		<input type="text" id="searchIRA" placeholder=" SEARCH UPLOADED DATA" style="padding: 8px 0px 8px 0px; margin: 2% 0% 2% 1%; width:21.3%">
		  		<div class="transLogTable">
			  		<table class="table table-hover table-striped">
			  		<thead>
			  			<tr style="font-size: 10px;">
							<th style="text-align:center;">&nbsp;</th>
							<th style="text-align:center;">EXTERNAL ID</th>
							<th style="text-align:center;">NETSUITE ID</th>
							<th style="text-align:center;">ENTITY</th>
							<th style="text-align:center;">DEPARTMENT</th>
							<th style="text-align:center;">PRINCIPAL</th>
							<th style="text-align:center;">LOCATION</th>
							<th style="text-align:center;">DATE</th>
							<th style="text-align:center;">UPLOADED BY</th>
			  			</tr>
			  		</thead>
			  		<tbody id="result-container">
			  			@if(count($returnauthorizations)>0)
				  			@foreach($returnauthorizations as $key=>$val)
				  			<tr>
					  			<td style="text-align:center;">
					  				@if(Auth::user()->role[0]->rolename=='Administrator')
									{{HTML::link('validation/delete/'.$val->transaction_id.'/'.$val->record_type,'Delete',array('style'=>'color:#c11313'))}} |
									@endif
					  				<a href="{{ Config::get('netsuite.returnauthorization').$val->record_internal_id }}">view</a>
					  			</td>
					  			<td style="text-align:center;">{{ $val->external_id }}</td>
					  			<td style="text-align:center;">{{ $val->record_internal_id }}</td>
					  			<td style="text-align:center;">{{ $val->entity }}</td>
					  			<td style="text-align:center;">{{ $val->department }}</td>
					  			<td style="text-align:center;">{{ $val->principal }}</td>
					  			<td style="text-align:center;">{{ $val->location }}</td>
					  			<td style="text-align:center;">{{ date('m-d-Y', strtotime($val->record_date)) }}</td>
					  			<td style="text-align:center;">{{ $val->user->name}}</td>
				  			</tr>
				  			@endforeach
				  			<tr>
				  				<td colspan="10" style="text-align:center;">{{ $returnauthorizations->links() }}</td>
				  			</tr>
			  			@else
				  			<tr><td colspan='10' style='font-size:12px; text-align:center;'>No Record Found</td></tr>
				  		@endif
			  		</tbody>
			  		</table>
		  		</div>
	  		</div>
  		</div>
	</div>
</div>
@endsection