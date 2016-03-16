@extends('discount.app')
@section('content')

<div class="side-body">
<div class="container-fluid">
 <div class="row">
    <div class="box col-md-12">
            <div class="box-content">
                {{ Form::open(['url' => 'discounts/discounts']) }}
                        {{ Form::hidden('user_id', Auth::user()->id)  }}
                        
                        {{ Form::label('customer_id', 'Customer : ', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                          {{ Form::select('customer_id', $customers, null, ['class' => 'js-example-responsive', 'id' => 'select_customer', 'style' => 'width: 100%']) }} 

                        </div>
                      <br>
                      <br>
                        {{ Form::label('item_id', 'Item : ', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                          {{ Form::select('item_id', $items , null,  ['class' => 'js-example-responsive', 'id' => 'select_item', 'style' => 'width: 100%']) }}
                        </div>
                      <br>
                      <br>
                        {{ Form::label('operation_id', 'Operation : ', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                          {{ Form::select('operation_id', $operations , null,  ['class' => 'js-example-responsive', 'id' => 'select_operation', 'style' => 'width: 100%']) }}
                        </div>
                      <br>
                      <br>
                        {{ Form::label('location_id', 'Location : ', ['class' => 'col-sm-2 control-label']) }}
                        <div class="col-sm-10">
                           {{ Form::select('location_id', $locations, null,  ['class' => 'js-example-responsive', 'id' => 'select_location', 'style' => 'width: 100%']) }}
                        </div>
                      <br>
                      <br>
                         {{ Form::label('price_id', 'Price List : ',  ['class' => 'col-sm-2 control-label']) }}
                         <div class="col-sm-10">
                           {{ Form::select('price_id', $prices, null,  ['class' => 'js-example-responsive', 'id' => 'select_price', 'style' => 'width: 100%']) }}
                         </div>
                      <br>
                      <br>
                    <div class="form-group">
                        {{ Form::label('disc1','Discount # 1 :', ['class' => 'col-sm-2 control-label'])}}
                        <div class="col-sm-10">
                          {{ Form::text('disc1', null, ['class' => 'form-control input']) }}
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        {{ Form::label('disc2','Discount # 2 :', ['class' => 'col-sm-2 control-label'])}}
                        <div class="col-sm-10">
                          {{ Form::text('disc2', null, ['class' => 'form-control input']) }}
                        </div>
                    </div>
                    <br>
                    <br>
                     <div class="form-group">
                        {{ Form::label('disc3','Discount # 3 :', ['class' => 'col-sm-2 control-label'])}}
                        <div class="col-sm-10">
                          {{ Form::text('disc3', null, ['class' => 'form-control input']) }}
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        {{ Form::label('disc4','Discount # 4 :', ['class' => 'col-sm-2 control-label'])}}
                        <div class="col-sm-10">
                           {{ Form::text('disc4', null, ['class' => 'form-control input']) }}
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        {{ Form::submit('ADD' , ['class' => 'btn btn-primary form-control']) }}
                    </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->    
</div>


 @if($errors->any())
  <ul class="alert alert-danger">
      @foreach($errors->all() as $error)
         <li> {{ $error }} </li>
      @endforeach
  </ul>
@endif

     
@stop