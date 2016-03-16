@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562;">File Template</h3>
	<div class="row">
		{{ Form::open(array('url'=>'filetemplate/'.$files->template_id,'method'=>'put')) }}
		<div class="row" style="margin-left:30px;">
			
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">FILENAME</label>
					<input type="text" name="filename" class="form-control" id="filename" value="{{ $files->filename }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('filename','<p>:message</p>')}}</font>
				</div>
			
				<div class="input-group custom-input-control">
				<label for="inactive_status">INACTIVE</label><br/>
				@if($files->inactive==1)
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;"checked>
				@else
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;">
				@endif
				</div>

			</div>

			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">HEADER</label>
					<input type="text" name="headername" class="form-control" id="headername" value="{{ Input::old('headername') }}">
					<font style="font-size: 10px; color:#770404;">{{ $errors->first('headername','<p>:message</p>')}}</font>
				</div>

				<div class="input-group custom-input-control">
					<a href="#" class="btn btn-info" id="btnEditAddHeader">Add Header</a>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<div id="header-container-edit" style="background-color:#fff; border-radius: 5px; height: 200px; width:340px; overflow:scroll;">
						<ul style="list-style:none; font-size: 16px;">
							<?php $i = 1; ?>
							@foreach($headers as $header)
								<li style="padding:2px;"><span id="header-data">{{ $header }}</span><a href="#" style="float:right;" id="header-{{ $i }}"><span class="glyphicon glyphicon-remove"></span></a></li>
								<?php $i++; ?>
							@endforeach
						</ul>
						<input type="hidden" id="headerData" name="headerData" value='{{ json_encode($headers) }}'>
					</div>
					<font style="font-size: 10px; color:#770404;">{{ Session::get('headersMessage') }}</font>
				</div>

			</div>
		</div>
		<div class="row" style="margin-left:30px;">
			<div class="col-md-4">
				{{ Form::submit('Save', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px;')) }}
				{{ HTML::link('filetemplate','Cancel', array('id'=>'submit','class'=>'btn btn-warning custom-submit-button','style'=>'width:150px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
