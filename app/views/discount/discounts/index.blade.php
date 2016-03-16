@extends('discount.app')
@section('content')
<div class="side-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        @if (Session::has('update_flash'))
                        <div class="alert alert-success fade in">
                            {{ Session::get('update_flash')}}
                        </div>
                        @endif

                        @if (Session::has('not_found'))
                        <div class="alert alert-success fade in">
                            {{ Session::get('not_found')}}
                        </div>
                        @endif

                        @if (Session::has('delete'))
                        <div class="alert alert-success fade in">
                            {{ Session::get('delete')}}
                        </div>
                        @endif
                        <div class="card-title">
                        <div class="title">Discount info <a href="{{ url('discounts/excel/discounts') }}"><i class=" glyphicon glyphicon-download-alt"></i></a></div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ Datatable::table()
                        ->addColumn('Customer', 'Item', 'Location', 'Operation', 'Price Lists', 'Discount 1', 'Discount 2', 'Discount 3', 'Discount 4', 'Options')       // these are the column headings to be shown
                        ->setUrl(route('api.discounts'))   // this is the route where data will be retrieved
                        ->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
