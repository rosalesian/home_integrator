@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562; margin-bottom:0px;">File Template</h3>
	
		@if(Session::has('message'))
		<div class="alert alert-success alert-dismissible" role="alert" style="width:98%; padding:10px; margin:10px 0px 0px 15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right:20px;"><span aria-hidden="true">&times;</span></button>
			{{Session::get('message')}}
		</div>
		@endif

	<div class="row" style="margin-top:40px;">
		
		<div class="row" style="margin-left:30px;">
			
			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">FILENAME</label>
					<div id="name">{{ $files->filename }}</div>
				</div>

				<div class="input-group custom-input-control">
					<label for="name">FILE PATH</label>
					<div id="name">{{ $files->file_path }}</div>
				</div>

				<div class="input-group custom-input-control">
					<label for="inactive_status">INACTIVE</label><br/>
					@if($files->inactive==1)
						<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;" disabled="disabled" checked>
					@else
						<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;" disabled="disabled">
					@endif
				</div>

			</div>

			<div class="col-md-4">
				<div class="input-group custom-input-control">
					<label for="name">HEADER</label>
						<div id="header-container" style="background-color:#fff; border-radius: 5px; height: 200px; width:340px; overflow:scroll;">
							<ul style="list-style:none; font-size: 16px;">
							@foreach($headers as $header)
								<li>{{ $header }}</li>
							@endforeach
							</ul>
						</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="dropdown">
					{{ HTML::link('filetemplate/'.$files->template_id.'/edit','Edit', array('id'=>'submit','class'=>'btn btn-success custom-submit-button','style'=>'width:120px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
					<a id="dLabel" data-target="#" class="btn btn-default custom-submit-button" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" style="width:100px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;">
					Action
					<span class="caret"></span>
					</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="margin-left:31%; margin-top:-2%;">
				<li>{{ HTML::link('filetemplate/create','New') }}</li>
				<li>{{ HTML::link('filetemplate','Lists') }}</li>
				</ul>
				</div>
			</div>	
		</div>


	</div>
</div>
@endsection
