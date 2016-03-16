@extends('layouts.default')
@section('content')
<div class="integration-container">
	<div class="row">
		<div class="col-md-4 custom-left-column">
				<div class="custom-container-process">
					<div style="padding-left:5px; padding-top:5px; padding-bottom:5px;"><b>STAGES</b></div>
					<div id="stageone" class="custom-label-stages" style="padding-left:5px;"><span>1. Choose a File to Upload</span></div>
					<div id="stagetwo" style="padding-left:5px;"><span>2. File Validation</span></div>
					<div id="stagethree" style="padding-left:5px;"><span>3. Uploading Validated File</span></div>
				</div>
		</div>
  		<div class="col-md-8 custom-right-column">
				<div class="formContainer">
				<h3>Scan and Upload CSV File</h3>
				<br/>
				{{ Form::open(array('files'=>true, 'id'=>'formValidate')) }}
				
				<span style="font-size:12px; color:#bfc7c9;">Principal	</span><br/>
				{{ Form::select('principal',['procterandgamble'=>'Procter and Gamble', 'nutriasia'=>'Nutri Asia Inc.','mondelez'=>'Mondelez','globe'=>'Globe'],null,array('class'=>'selectType'))}}<br/>

				<span style="font-size:12px; color:#bfc7c9;">Choose a Record Type</span><br/>
				{{ Form::select('type',['invoice'=>'Invoice', 'purchaseorder'=>'Purchase Order', 'returnauthorization'=> 'Return Authorization'],null,array('class'=>'selectType'))}}<br/>

				
				<span style="font-size:12px; color:#bfc7c9;">Choose a CSV file to be uploaded</span><br/>
				{{Form::text('alternativeTextBox',null, array('id'=>'alternativeTextBox','disabled'=>'true'))}}
				<div class="alternativeButton btn btn-primary"><span>Choose File</span>
				{{ Form::file('csvFile', array('id'=>'csvFile')) }}
				</div><br/>
				{{ Form::submit('Validate',array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','disabled'=>'true')) }}
				{{ Form::close() }}

				@if(Session::has('message'))
				<p style="color:red;">{{ Session::get('message') }}</p>
				@endif
				</div>
				<span id="remarks"></span>
				<div class="loading-container">
				{{ HTML::image('upload-loader.GIF','upload', array('id'=>'upload-loader')) }}
				{{ HTML::image('validate-loader.GIF','validate', array('id'=>'validate-loader')) }}
				</div>
		  		
		  		<div class="error-container alert alert-danger" role="alert">
						<span id="errorContainer"></span>
						{{ HTML::link('validation/download/result','download result', array('id'=>'downloadLink','class'=>'btn btn-danger')) }}
		  		</div>
  		</div>
	</div>
</div>
@endsection