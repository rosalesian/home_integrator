<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="{{ url('/discounts') }}"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        </li>
                         <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Discount</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{ url('/discounts/discounts') }}">List</a></li>
                                <li><a href="{{ url('discounts/discounts','create') }}">Add</a></li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="{{ url('/discounts/customers') }}"><i class="glyphicon glyphicon-font"></i><span> Customer</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ url('/discounts/items') }}"><i class="glyphicon glyphicon-picture"></i><span> Items</span></a>
                        </li>
                        <li class="nav-header hidden-md">Option</li>
                        <li>
                            <a class="ajax-link" href="{{ url('/discounts/operations') }}">
                                <i class="glyphicon glyphicon-book"></i>
                                <span> 
                                    Operation
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="ajax-link" href="{{ url('/discounts/locations') }}">
                                <i class="glyphicon glyphicon-align-justify"></i>
                                <span> 
                                    Location
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="ajax-link" href="{{ url('/discounts/pricelists') }}">
                                <i class="glyphicon glyphicon-file"></i>
                                <span> 
                                    Price List
                                </span>
                            </a>
                        </li>
                        <li><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-lock"></i><span> Login Page</span></a>
                        </li>
                    </ul>
                  
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>
         <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
         
</div>