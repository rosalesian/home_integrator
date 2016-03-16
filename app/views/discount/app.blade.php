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

    <link href="{{ asset('css/discount.css') }}" rel="stylesheet">
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

    <style type="text/css">
        #chartdiv {
            width		: 100%;
            height		: 500px;
            font-size	: 11px;
        }
    </style>

  <!--
  Loading demo dependencies. They are used here only to enhance the examples on this page
  -->
<!--   <link data-jsfiddle="common" rel="stylesheet" media="screen" href="css/samples.css?20140331"> -->
  <script type="text/javascript">
    var URL = "{{ URL::to('/') }}";
  </script>
  <script src="{{ asset('js/my_sample.js')}}"></script>
  <script src="{{ asset('js/highlight/highlight.pack.js') }}"></script>
  <link rel="stylesheet" media="screen" href="{{ asset('js/highlight/styles/github.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/logo20.png') }}">
</head>

<body class="flat-blue">
     <div class="app-container">
        <div class="row content-container">
            @include('discount.includes.header')
            @include('discount.includes.sidebars')
            <div class="container-fluid">
              @yield('content')
            </div>
        </div>
        
    </div>

<footer class="app-footer">
        <div class="wrapper">
            <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Dranix.
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

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="{{ asset('js/pie_chart.js') }}"></script>
</body>

</html>
