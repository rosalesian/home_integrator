<!--MODAL-->
  <div class="modal" id="modalChangePassword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <form id="formUpdatePass">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Change Password</h4>
      </div>
      <div id="error-updatePass" class="alert alert-danger" role="alert" style="font-size: 12px; width:95%; margin:auto; margin-top:2%; padding:5px;"></div>
      <div class="modal-body">
          <div class="form-group">
            <label for="message-text" class="control-label">New Password:</label>
            <input type="password" class="form-control" name="newPass" id="newPass">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Confirm Password:</label>
            <input type="password" class="form-control" name="confirmPass" id="confirmPass">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-warning" value="Save">
      </div>
      </form>
    </div>
  </div>
</div><!-- /.END MODAL-->
	<!--NAV BARS-->
	<nav class="navbar navbar-inverse" style="border-radius:0;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="validation"><font style="font-size:20px;">Integrator</font></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if($activeLink=='home')
        <li class="active">{{ HTML::link('validation','Upload') }}</li>
        @else
        <li>{{ HTML::link('validation','Upload') }}</li>
        @endif
        
        @if($activeLink=='log')
        	<li class="dropdown active">
        @else
        	<li class="dropdown">
        @endif  
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Transaction&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" style="margin-top:3%;">
              <li>{{ HTML::link('validation/invoices','Invoices') }}</li>
              <li>{{ HTML::link('validation/purchaseorders','Purchase Orders') }}</li>
              <li>{{ HTML::link('validation/returnauthorizations','Return Authorizations') }}</li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Templates&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" style="margin-top:4%;">
              <li>{{ HTML::link('template/download/invoice','Invoice') }}</li>
              <li>{{ HTML::link('template/download/po','Purchase Order') }}</li>
              <li>{{ HTML::link('template/download/ira','Issue Return Authorization') }}</li>
          </ul>
        </li>
        @if(Auth::user()->role[0]->rolename=='Administrator')
          @if($activeLink=='system_manager')
          <li class="dropdown active">
          @else
          <li class="dropdown">
          @endif
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">System Manager&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" style="margin-top:3%;">
              <li>{{ HTML::link('user','User') }}</li>
              <li>{{ HTML::link('role','Role') }}</li>
              <li>{{ HTML::link('branch','Branch') }}</li>
               <li>{{ HTML::link('filetemplate','File Template') }}</li>
          </ul>
        </li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()['name'] }}&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu"  style="margin-top:3%;">
              @if(Auth::user()->role[0]->rolename=='Administrator')
                <li role="presentation"><a href="{{ url('reset_requests_view')}}">Reset Requests <span class="badge">{{ count(User::where('reset_request',1)->get()) }}</span></a></li>
              @endif
              <li><a href="#" data-toggle="modal" data-target="#modalChangePassword">Change Password</a></li>
              <li class="divider"></li>
              <li>
               {{ HTML::link('logout','Logout', array('class'=>'dropdown-toggle')) }}
            </li>
          </ul>
        </li>  
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!-- /.END NAV BAR-->