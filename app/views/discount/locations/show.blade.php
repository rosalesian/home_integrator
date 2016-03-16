@extends('discount.app')
@section('content')
<div class="side-body">
    <div class="container-fluid">
        <div class="row">
           <div class="card profile">
                <div class="card-body">
                    <div class="name"></div>
                    <div class="description">
                         <ul class="dashboard-list">
                        <li>
                            
                            <strong>Name:</strong> <a href="#">{{ $location->name }}
                            </a><br>
                            <strong>Create:</strong> {{ $location->created_at}} <br>
                            <strong>Reference:</strong> {{ $location->reference_id}} <br>
                            <strong>Status:</strong> <span class="label-success label label-default">Approved</span>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <i class="fa fa-users"></i> 10 Friends
                </div>
            </div>
        </div>
    </div>
</div>
@stop