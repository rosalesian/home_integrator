<!DOCTYPE html>
<html>

<head>
  <title>Discount</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
  <!-- CSS Libs -->
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/bootstrap-switch.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/checkbox3.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/css/select2.min.css') }}">
  <!-- CSS App -->


  <!-- hanson table js-->
  <link href="{{ asset('css/elfinder.min.css') }}" rel='stylesheet'>
  <link href="{{ asset('css/elfinder.theme.css') }}" rel='stylesheet'>

  <script src="{{ asset('bower_components/jquery/jquery.min.js') }}"></script>


  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/flat-blue.css') }}">
  <!--Item pugin -->

  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="{{ asset('dist/handsontable.css') }}">
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="{{ asset('dist/pikaday/pikaday.css') }}">
  <script data-jsfiddle="common" src="{{ asset('dist/pikaday/pikaday.js') }}"></script>
  <script data-jsfiddle="common" src="{{ asset('dist/moment/moment.js') }}"></script>
  <script data-jsfiddle="common" src="{{ asset('dist/zeroclipboard/ZeroClipboard.js') }}"></script>
  <script data-jsfiddle="common" src="{{ asset('dist/handsontable.js') }}"></script>

  <!--
  Loading demo dependencies. They are used here only to enhance the examples on this page
  -->
<!--   <link data-jsfiddle="common" rel="stylesheet" media="screen" href="css/samples.css?20140331"> -->
  <script type="text/javascript">
    var base_url = "{{ URL::to('/') }}";

  </script>
  <script src="{{ asset('js/discount.js')}}"></script>
  <script src="{{ asset('js/highlight/highlight.pack.js') }}}"></script>
  <link rel="stylesheet" media="screen" href="{{ asset('js/highlight/styles/github.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">

  <script src="js/ga.js"></script>


</head>

<body class="flat-blue">
  <div class="app-container">
    <div class="row content-container">
        @include('discount.includes.header')
        @include('discount.includes.sidebars')
        <div class="container-fluid">
           <div class="container-fluid">
            <div class="side-body">
              <div class="row">
                  <div class="content">
                    <button name="dump" data-dump="#example5" data-instance="hot5" title="Prints current data source to Firebug/Chrome Dev Tools" class="btn btn-info">Add Discount
                    </button>
                    <button name="clear" id="clear" class="btn btn-default">Clear</button>                   
                    <div id="container">
                      <div class="columnLayout">
                        <div class="rowLayout">
                          <div class="descLayout">
                            <div class="pad" data-jsfiddle="example5">
                              <a name="dataschema"></a>
                              <div style='overflow:hide; width:500;height:280px;' id="example5"></div>
                            </div>
                            <script data-jsfiddle="example5">
                              //get the customers
                              var base_url = "{{ URL::to('/') }}"

                                $.ajax({
                                    url: base_url+"/discounts/getcustomers",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                      addCustomer(data); 
                                    },
                                    error: function(error) {
                                      console.log(error);
                                    } 
                                });
                                //instantiate the customer
                                var customer = [];
                                function addCustomer(customers) {
                                    for(var i = 0; i<customers.length; i++ ) {
                                      customer.push(customers[i].name);
                                  }

                                };

                                //get the items
                                $.ajax({
                                  url: base_url+"/discounts/getitems",
                                  type: "GET",
                                  dataType: "json",
                                  success: function(data) {
                                    addItems(data);
                                  },
                                  error: function(err) {
                                    console.log(err);
                                  }
                                });

                                //instantiate the item array
                                var item = [];
                                function addItems(items) {
                                  for(var i = 0, len = items.length; i < len; i++ ) {
                                      item.push(items[i].name);
                                  }
                                };


                                //get locations
                                $.ajax({
                                  url: base_url+"/discounts/getlocations",
                                  type: "GET",
                                  dataType: "json",
                                  success: function(data) {
                                    addLocations(data);
                                  },
                                  error: function(err) {
                                    console.log(err);
                                  }
                                });

                                //instantiate location array
                              
                                 var locations = [];
                                 function addLocations(item) {
                                    for(var i = 0, len = item.length; i < len; i++) {
                                        locations.push(item[i].name);
                                    }
                                 };

                                //get pricelists
                                $.ajax({
                                  url: base_url+"/discounts/getpricelists",
                                  type: "GET",
                                  dataType: "json",
                                  success: function(data) {
                                    addPrice(data);
                                  },
                                  error: function(err) {
                                    console.log(err);
                                  }
                                });
                               
                                //instantiate pricelists array
                                var pricelists = [];

                                function addPrice(price) {
                                  for(var i = 0, len = price.length; i < len; i++) {
                                    pricelists.push(price[i].name);
                                  }
                                };


                                //get operations
                                $.ajax({
                                  url: base_url+"/discounts/getoperations",
                                  type: "GET",
                                  dataType: "json",
                                  success: function(data) {
                                    addOperations(data);
                                  },
                                  error: function(err) {
                                    console.log(err);
                                  }
                                });

                                //instantiate operations array
                                var operations = [];
                                function addOperations(operation) {
                                  for(var i = 0, len = operation.length; i < len; i++) {
                                    operations.push(operation[i].name);
                                  }
                                }

                                //
                                var
                                  container = document.getElementById('example5'),
                                  hot5;
                                  hot5 = new Handsontable(container, {
                                  data: [],
                                  startRows: 5,
                                  startCols: 4,
                                  colWidths: [200, 200, 200, 200, 200, 60, 60, 60, 60],
                                  columnSorting: true,
                                  colHeaders: ['Customer','Item', 'Location', 'Price List',  'Operation' , '%  1', '%  2', '%  3', '%  4'],
                                  rowHeaders: true,
                                  columns: [
                                    {
                                      type: 'autocomplete',
                                      source: customer,
                                      strict: true
                                    },
                                    {
                                      type: 'autocomplete',
                                      source: item,
                                      strict: true
                                    },
                                    {
                                      type: 'autocomplete',
                                      source: locations,
                                      strict: true
                                    },
                                    {
                                      type: 'autocomplete',
                                      source: pricelists,
                                      strict: true
                                    },
                                    {
                                      type: 'autocomplete',
                                      source: operations,
                                      strict: true
                                    },
                                    {data: 'dist1'},
                                    {data: 'dist2'},
                                    {data: 'dist3'},
                                    {data: 'dist4'},
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
          </div>
        </div>
      </div>
    </div>
  </div>
  

<footer class="app-footer">
        <div class="wrapper">
            <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
        </div>
    </footer>
    <div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="{{ asset('lib/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/bootstrap-switch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/ace/ace.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/ace/mode-html.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/js/ace/theme-github.js') }}"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
</body>

</html>
