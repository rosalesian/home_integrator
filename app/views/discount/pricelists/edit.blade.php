@extends('discount.app')
@section('content')

 @if($errors->any())
  <ul class="alert alert-danger">
      @foreach($errors->all() as $error)
         <li> {{ $error }} </li>
      @endforeach
  </ul>
@endif
<div class="container-fluid">
    <div class="side-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title">Operation form</div>
                        </div>
                    </div>
                    <div class="card-body">
                      {{ Form::model($price, ['method' => 'PATCH' , 'action' => ['PricelistsController@update', $price->id]]) }}
                          <div class="form-group">
                              {{ Form::label('name','Price Name :') }}
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