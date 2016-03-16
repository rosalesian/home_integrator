@extends('layouts.default')
@section('content')
<div class="integration-container" style="padding:10px;">
<h3 style="border-bottom:1px solid #666562;padding-bottom:10px; color:#666562; margin-bottom:0px;">Users</h3>
	
		@if(Session::has('message'))
		<div class="alert alert-success alert-dismissible" role="alert" style="width:98%; padding:10px; margin:10px 0px 0px 15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-right:20px;"><span aria-hidden="true">&times;</span></button>
			{{Session::get('message')}}
		</div>
		@endif

	<div class="row" style="margin-top:40px;">
		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="input-group">
					<label for="name">NAME</label>
					<div id="name">{{ $user->name }}</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<label for="username">USERNAME</label>
					<div id="username">{{ $user->username }}</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<label for="branchname">BRANCH</label>
					<div id="name">{{ $user->branch[0]->branchname }}</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="input-group">
				<label for="inactive_status">NETSUITE_ROLE</label><br/>
				@if($user->netsuite_role==3)
					<div id="name">Administrator</div>
				@elseif($user->netsuite_role==1063)
					<div id="name">BO-in-charge</div>
				@elseif($user->netsuite_role==1089)
					<div id="name">Encoder</div>
				@elseif($user->netsuite_role==1028)
					<div id="name">Invoicing Clerk</div>
				@elseif($user->netsuite_role==1092)
					<div id="name">PO In-Charge</div>
				@elseif($user->netsuite_role==1045)
					<div id="name">Warehouse Custodian</div>
				@else
					<div id="name"> </div>				
				@endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<label for="email">EMAIL</label>
					<div id="name">{{ $user->email }}</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
				<label for="rolename">ROLE</label>
				<div id="name">{{ $user->role[0]->rolename }}</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="input-group">
				<label for="inactive_status">INACTIVE</label><br/>
				@if($user->inactive==1)
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;" disabled="disabled" checked>
				@else
				<input type="checkbox" name="inactive_status" id="inactive_status" style="width:20px; height:20px;" disabled="disabled">
				@endif
				</div>
			</div>
		</div>
		<div class="row" style="margin:15px; font-size:14px; color:#666562;">
			<div class="col-md-4">
				<div class="dropdown">
					{{ HTML::link('user/'.$user->id.'/edit','Edit', array('id'=>'submit','class'=>'btn btn-success custom-submit-button','style'=>'width:120px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;')) }}
					<a id="dLabel" data-target="#" class="btn btn-default custom-submit-button" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false" style="width:100px; padding-top:7px; padding-bottom:7px; margin:10px 5px 10px 0px;">
					Action
					<span class="caret"></span>
					</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="margin-left:31%; margin-top:-2%;">
				<li>{{ HTML::link('user/create','New') }}</li>
				<li>{{ HTML::link('user','Lists') }}</li>
				<li><a href="#" data-toggle="modal" data-target="#modalResetPassword" >Reset Password</a></li>
				</ul>
				</div>
			</div>	
		</div>


	</div>
</div>
<!--MODAL-->
  <div class="modal" id="modalResetPassword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Reset Password</h4>
      </div>
 	{{ Form::open(array('url'=>'user/resetPassword','method'=>'post')) }}
      <div class="modal-body">
      		<input type="hidden" name="userid" value="{{ $user->id }}">
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
