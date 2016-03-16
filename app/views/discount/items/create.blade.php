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
            <button name="dump" data-dump="#example5" data-instance="hot5" title="Prints current data source to Firebug/Chrome Dev Tools" class="btn btn-info">Add Item
            </button>
            <button name="clear" id="clear" class="btn btn-default">Clear</button>                   
          	<div id="container">
	            <div class="columnLayout">
	              	<div class="rowLayout">
		                <div class="descLayout">
		                  	<div class="pad" data-jsfiddle="example5">
		                    	<a name="dataschema"></a>
		                    	<div style='overflow:hide; width:850px;height:380px;' id="example5"></div>
		                 	</div>
		                </div>
							<script data-jsfiddle="example5">
							var
							  container = document.getElementById('example5'),
							  hot5;
							  hot5 = new Handsontable(container, {
							  data: [],
							  startRows: 5,
							  startCols: 4,
							  colWidths: [300, 300],
							  columnSorting: true,
							  colHeaders: ['Item Name', 'Reference'],
							  rowHeaders: true,
							  columns: [
							    {data: 'name'},
							    {data: 'reference'}
							  ],
							  minSpareRows: 1,
							   manualColumnResize: true,
							});

							$('#clear').click(function(){
							   hot5.clear();
							});

							</script>
			            </div>
			        </div>
			    </div>               
            </div>
		</div>
	</div>
</div>   
   
@stop