@extends('discount.app')
@section('content')
<div class="side-body">
    <div class="container-fluid">
       <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title">Discount Info</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="step">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                 <li role="step" class="active step-success">
                                    <a href="#step1-2" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                        <div class="icon fa fa-truck"></div>
                                        <div class="step-title">
                                            <div class="title">Discount</div>
                                            <div class="description">discount 1 to 4</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step2-2" role="tab" id="step2-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-credit-card"></div>
                                        <div class="step-title">
                                            <div class="title">Item</div>
                                            <div class="description">Item information</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step3-2" role="tab" id="step3-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-credit-card"></div>
                                        <div class="step-title">
                                            <div class="title">Customer</div>
                                            <div class="description">customer information</div>
                                        </div>
                                    </a>
                                </li>

                                 <li role="step">
                                    <a href="#step4-2" role="tab" id="step4-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-credit-card"></div>
                                        <div class="step-title">
                                            <div class="title">Location</div>
                                            <div class="description">Location information</div>
                                        </div>
                                    </a>
                                </li>

                                 <li role="step">
                                    <a href="#step5-2" role="tab" id="step5-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-credit-card"></div>
                                        <div class="step-title">
                                            <div class="title">Pricelists</div>
                                            <div class="description">Price information</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="step1-2" aria-labelledby="home-tab">
                                    <p>
                                        <ul class="dashboard-list">
                                            <li>
                                                
                                                <strong>Name:</strong> <a href="#">{{ $discount->users['email']}}
                                                </a><br>
                                                <strong>Create:</strong> {{ $discount->created_at->diffForHumans()}} <br>
                                                <strong>Reference:</strong> {{ $discount->reference_id}} <br>
                                                <strong>Discount 1 :</strong> {{ $discount->disc1}} <br>
                                                <strong>Discount 2 :</strong> {{ $discount->disc2}} <br>
                                                <strong>Discount 3 :</strong> {{ $discount->disc3}} <br>
                                                <strong>Discount 4 :</strong> {{ $discount->disc4}} <br>
                                                <strong>Status:</strong> <span class="label-success label label-default">Active</span>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="step2-2" aria-labelledby="profile-tab">
                                    <p>
                                        <ul class="dashboard-list">
                                            <li>
                                                
                                                <strong>Name:</strong> <a href="#">{{ $discount->items['name']}}
                                                </a><br>
                                                <strong>Create:</strong> {{ $discount->items['created_at']->diffForHumans()}} <br>
                                                <strong>Reference:</strong> {{ $discount->items['reference_id']}} <br>
                                                <strong>Status:</strong> <span class="label-success label label-default">{{ $discount->items['deleted_at'] = ($discount->items['deleted_at'] == "" ) ? "Active" : "InActive" }}  </span>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="step3-2" aria-labelledby="dropdown1-tab">
                                    <p>
                                         <ul class="dashboard-list">
                                            <li>           
                                                <strong>Name:</strong> <a href="#">{{ $discount->customers['name']}}
                                                </a><br>
                                                <strong>Create:</strong> {{ $discount->customers['created_at']->diffForHumans()}} <br>
                                                <strong>Reference:</strong> {{ $discount->customers['reference_id']}} <br>
                                                <strong>Status:</strong> <span class="label-success label label-default">{{ $discount->customers['deleted_at'] = ($discount->customers['deleted_at'] == "" ) ? "Active" : "InActive" }}  </span>
                                            </li>
                                        </ul>
                                    </p>
                                </div>

                                 <div role="tabpanel" class="tab-pane fade" id="step4-2" aria-labelledby="dropdown1-tab">
                                    <p>
                                         <ul class="dashboard-list">
                                            <li>
                                                
                                                <strong>Name:</strong> <a href="#">{{ $discount->locations['name']}}
                                                </a><br>
                                                <strong>Create:</strong> {{ $discount->locations['created_at']->diffForHumans()}} <br>
                                                <strong>Reference:</strong> {{ $discount->locations['reference_id']}} <br>
                                                <strong>Status:</strong> <span class="label-success label label-default">{{ $discount->locations['deleted_at'] = ($discount->locations['deleted_at'] == "" ) ? "Active" : "InActive" }}  </span>
                                            </li>
                                        </ul>
                                    </p>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="step5-2" aria-labelledby="dropdown1-tab">
                                    <p>
                                         <ul class="dashboard-list">
                                            <li>
                                                
                                                <strong>Name:</strong> <a href="#">{{ $discount->operations['name']}}
                                                </a><br>
                                                <strong>Create:</strong> {{ $discount->operations['created_at']->diffForHumans()}} <br>
                                                <strong>Reference:</strong> {{ $discount->operations['reference_id']}} <br>
                                                <strong>Status:</strong> <span class="label-success label label-default">{{ $discount->operations['deleted_at'] = ($discount->operations['deleted_at'] == "" ) ? "Active" : "InActive" }}  </span>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@stop