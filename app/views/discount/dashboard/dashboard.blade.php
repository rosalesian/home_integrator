@extends('discount.app')
@section('content')
<div class="side-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-body">
						<div id="chartdiv"></div>
						<div class="container-fluid">
						  <div class="row text-center" style="overflow:hidden;">
								<div class="col-sm-3" style="float: none !important;display: inline-block;">
									<label class="text-left">Angle:</label>
									<input class="chart-input" data-property="angle" type="range" min="0" max="60" value="30" step="1"/>
								</div>
								<div class="col-sm-3" style="float: none !important;display: inline-block;">
									<label class="text-left">Depth:</label>
									<input class="chart-input" data-property="depth3D" type="range" min="1" max="25" value="10" step="1"/>
								</div>
								<div class="col-sm-3" style="float: none !important;display: inline-block;">
									<label class="text-left">Inner-Radius:</label>
									<input class="chart-input" data-property="innerRadius" type="range" min="0" max="80" value="0" step="1"/>
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