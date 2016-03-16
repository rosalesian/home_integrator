@extends('discount.app')
@section('search_item')

<div class="box col-md-8">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><a href="{{ url('discounts/items') }}"><i class="glyphicon glyphicon-home"></i></a> Item Info</h2>

            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                        class="glyphicon glyphicon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round btn-default"><i
                        class="glyphicon glyphicon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="box-content">
                <ul class="dashboard-list">
                    <li>
                        @foreach($item as $data)
                        <strong>Name:</strong> <a href="#">{{ $data->name }}
                        </a><br>
                        <strong>Create:</strong> {{ $data->created_at}} <br>
                        <strong>Reference:</strong> {{ $data->reference_id}} <br>
                        <strong>Status:</strong> <span class="label-success label label-default">Approved</span>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop