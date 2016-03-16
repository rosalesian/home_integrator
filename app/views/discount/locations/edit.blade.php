@extends('discount.app')
@section('content')

 @if($errors->any())
  <ul class="alert alert-danger">
      @foreach($errors->all() as $error)
         <li> {{ $error }} </li>
      @endforeach
  </ul>
@endif
 <!-- Main Content -->
<div class="container-fluid">
    <div class="side-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title">Locations form</div>
                        </div>
                    </div>
                    <div class="card-body">
                      {{ Form::model($location, ['method' => 'PATCH' , 'action' => ['LocationsController@update', $location->id]]) }}
                          <div class="form-group">
                              {{ Form::label('name','Item Name :') }}
                              {{ Form::text('name', null, ['class' => 'form-control input']) }}
                          </div>
                          <div class="form-group">
                              {{ Form::label('reference_id','Reference :') }}
                              {{ Form::text('reference_id', null, ['class' => 'form-control input']) }}
                          </div>
                          <div class="form-group">
                              {{ Form::submit('EDIT' , ['class' => 'btn btn-primary form-control']) }}
                          </div>
                    {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop