<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/', function()
{

	return View::make('login')->with('title','Login');

});

Route::get('logout', array('uses'=>'LoginController@getLogout'));
Route::post('login', array('uses'=>'LoginController@postLogin'));
Route::post('reset_request',array('uses'=>'LoginController@resetRequest'));
Route::get('reset_requests_view',array('uses'=>'LoginController@viewResetRequests'));
Route::post('resetPassword',array('uses'=>'LoginController@resetPassword'));

Route::group(array('before'=>'auth'), function(){

	if(Auth::check())
	{
		if(Auth::user()->role[0]->rolename=='Administrator')
		{
			Route::resource('user','UserController');
			Route::resource('role','RoleController');
			Route::resource('branch','BranchController');
			Route::get('validation/delete/{id}/{recordid}','ValidateController@deleteTransaction');
		}
	}

	Route::post('user/resetPassword',array('uses'=>'UserController@resetPassword'));
	Route::get('validation',array('uses'=>'validateController@get_index'));

	Route::get('validation/invoices', array('uses'=>'validateController@viewInvoice'));
	Route::get('validation/purchaseorders', array('uses'=>'validateController@viewPO'));
	Route::get('validation/returnauthorizations', array('uses'=>'validateController@viewIRA'));

	Route::post('validation/searchLogByDateInvoice', array('uses'=>'validateController@searchLogByDateInvoice'));
	Route::post('validation/searchLogByValueInvoice', array('uses'=>'validateController@searchLogByValueInvoice'));
	Route::post('validation/searchLogByDatePO', array('uses'=>'validateController@searchLogByDatePO'));
	Route::post('validation/searchLogByValuePO', array('uses'=>'validateController@searchLogByValuePO'));
	Route::post('validation/searchLogByDateIRA', array('uses'=>'validateController@searchLogByDateIRA'));
	Route::post('validation/searchLogByValueIRA', array('uses'=>'validateController@searchLogByValueIRA'));

	Route::post('validation/updatePassword', array('uses'=>'LoginController@postUpdatePassword'));

	/** ROUTE FOR DOWNLOADING TEMPLATES**/
	Route::get('template/download/invoice',array('uses'=>'downloadController@downloadInvoiceTemplate'));
	Route::get('template/download/po',array('uses'=>'downloadController@downloadPOTemplate'));
	Route::get('template/download/ira',array('uses'=>'downloadController@downloadIRATemplate'));
	/**********************************/

	/** ROUTE FOR DOWNLOADING RESULTS THAT FAILED THE VALIDATION **/
	Route::get('validation/download/result', array('as'=>'download','uses'=>'downloadController@get_download'));
	/**********************************/

	Route::post('validation/validate', array('as'=>'validate','uses'=>'validateController@post_validate'));
	Route::post('validation/upload', array('as'=>'validate','uses'=>'validateController@post_upload'));
	/** VALIDATE USING VALIDATOR CLASS VIA JQUERY AJAX **/
	Route::post('validation/Input', array('uses'=>'validateController@post_validateInput'));

	Route::get('validation/customers', array('uses'=>'uploadCustomerController@viewCustomerUpload'));
	Route::post('validation/customers/upload', array('as'=>'uploadCustomer', 'uses'=>'uploadCustomerController@post_upload'));
	Route::get('validation/customers/download', array('as'=>'downloadCustomer','uses'=>'uploadCustomerController@get_download'));

	//upload controller
	Route::resource('upload', 'UploadController');
	Route::resource('filetemplate','fileTemplateController');

	/*
		DISCOUNT 
		Author: Ian Rosales
		Created: 12-11-15
	*/
	//ITEM MODULE
	if(Auth::check()) 
	{
		if(Auth::user()->role[0]->rolename == 'Discount-Data Admin' || Auth::user()->role[0]->rolename == 'Discount-Data User')
		{
			Route::resource('discounts/items', 'ItemsController');
			//add cache
			Route::get('discounts/items', 'ItemsController@index')->before('cache.fetch')->after('cache.put');
			Route::post(
		    'search/items', 
		    [
		        'as' => 'item.search', 
		        'uses' => 'itemsController@postSearch'
		    ]
			);

			Route::post('discounts/items/create/add/items', ['uses' => 'ItemsController@addItems']);
			

			//CUSTOMER MODULE
			Route::resource('discounts/customers', 'CustomersController');
			//add cache
			Route::get('discounts/customers', 'CustomersController@index')->before('cache.fetch')->after('cache.put');

			Route::post(
			    'search/customers', 
			    [
			        'as' => 'customers.search', 
			        'uses' => 'CustomersController@postSearch'
			    ]
			);

			Route::post('discounts/customers/create/add/customers', ['uses' => 'CustomersController@addCustomers']); 
			/*
			DISCOUNTS MODULE
			created by : rosales ian
			created at: 12-14-15
			*/

			Route::resource('discounts/discounts','DiscountsController');
			Route::post(
			    'posts/search', 
			    [
			        'as' => 'posts.search', 
			        'uses' => 'DiscountsController@postSearch'
			    ]
			);

			/*
				LOCATIONS MODULE
				create by : rosales ian
				created at : 12-14-15
			*/

			Route::resource('discounts/locations', 'LocationsController');
			//adding memcache
			Route::get('discounts/locations',  'LocationsController@index')->before('cache.fetch')->after('cache.put');
			Route::post(
			    'posts/location', 
			    [
			        'as' => 'locations.search', 
			        'uses' => 'DiscountsController@postSearch'
			    ]
			);

			Route::post('discounts/locations/create/add/locations', ['uses' => 'LocationsController@addLocations']);

			/*
				PRICELISTS MODULE
				create by : rosales ian
				created at : 12-21-15
			*/
			Route::post('discounts/pricelists/create/add/pricelists', ['uses' => 'PricelistsController@addPrice']);

			/*
				OPERATIONS MODULE
				create by : rosales ian
				created at : 12-18-15
			*/
			Route::resource('discounts/operations', 'OperationsController');
			//adding memcache
			Route::get('discounts/operations', 'OperationsController@index')->before('cache.fetch')->after('cache.put');
			Route::post(
		    'search/operations', 
			    [
			        'as' => 'operations.search', 
			        'uses' => 'OperationsController@postSearch'
			    ]
			);

			Route::post('discounts/operations/create/add/operations', ['uses' => 'OperationsController@addOperations']);

			/*
				PRICELISTS MODULE
				create by : rosales ian
				created at : 12-18-15
			*/
			Route::resource('discounts/pricelists', 'PricelistsController');
			//adding memcache
			Route::get('discounts/pricelists', 'PricelistsController@index')->before('cache.fetch')->after('cache.put');
			Route::post(
		    'search/pricelists', 
			    [
			        'as' => 'pricelists.search', 
			        'uses' => 'PricelistsController@postSearch'
			    ]
			);


			/*
			Dashboard
			*/
			Route::get('discounts', ['uses' => 'ItemsController@Dashboard'])->before('cache.fetch')->after('cache.put');

			Route::get('discounts/paichart', ['uses' => 'ApiController@report']);

			/*
				DISCOUNT UPLOAD MODULE
				create by : rosales ian
				created at : 12-28-15
			*/

			Route::get('discounts/upload', ['uses' => 'DiscountsController@upload']);
			Route::get('discounts/getcustomers', ['uses' => 'CustomersController@getCustomers']);
			Route::post('discounts/addDiscount', ['uses' => 'DiscountsController@addDiscount']);

			/*
				DISCOUNT GET ITEM
				create by : rosales ian
				created at : 12-29-15
			*/
			Route::get('discounts/getitems', ['uses' => 'ItemsController@getItems']);
			Route::get('discounts/getlocations', ['uses' => 'LocationsController@getLocations']);
			Route::get('discounts/getpricelists', ['uses' => 'PricelistsController@getPricelists']);
			Route::get('discounts/getoperations', ['uses' => 'OperationsController@getOperations']);


			//export data to excel
			Route::get('discounts/excel/items', function(){

				$items = Item::get();
				Excel::create('items', function($excel) use($items) {
					$excel->sheet('Sheet 1', function($sheet) use($items) {
				        $sheet->fromArray($items);
				    });
				})->export('xls');	
			});

			Route::get('discounts/excel/customers', function(){
				$customers = Customer::get();
				Excel::create('customers', function($excel) use($customers) {
					$excel->sheet('Sheet 1', function($sheet) use($customers) {
				        $sheet->fromArray($customers);
				    });
				})->export('xls');	

			});

			Route::get('discounts/excel/operations', function(){
				$operations = Operation::get();
				Excel::create('operations', function($excel) use($operations) {
					$excel->sheet('Sheet 1', function($sheet) use($operations) {
				        $sheet->fromArray($operations);
				    });
				})->export('xls');	

			});

			Route::get('discounts/excel/locations', function(){
				$locations = Location::get();
				Excel::create('locations', function($excel) use($locations) {
					$excel->sheet('Sheet 1', function($sheet) use($locations) {
				        $sheet->fromArray($locations);
				    });
				})->export('xls');	

			});

			Route::get('discounts/excel/pricelists', function(){
				$pricelists = Pricelist::get();
				Excel::create('pricelists', function($excel) use($pricelists) {
					$excel->sheet('Sheet 1', function($sheet) use($pricelists) {
				        $sheet->fromArray($pricelists);
				    });
				})->export('xls');	

			});

			//need to customize
			Route::get('discounts/excel/discounts', function(){
				$discounts = Discount::get();
				Excel::create('discounts', function($excel) use($discounts) {
					$excel->sheet('Sheet 1', function($sheet) use($discounts) {
				        $sheet->fromArray($discounts);
				    });
				})->export('xls');	

			});



			//adding url filter for cache
			Route::filter('cache.fetch', 'UserController@fetch');
			Route::filter('cache.put', 'UserController@put');

            //Data table in laravel
            Route::get('discounts/data/getItems', ['as' => 'api.items', 'uses' => 'ItemsController@tableGetItems']);
            //get all discounts
            Route::get('discounts/data/getDiscounts', ['as' => 'api.discounts', 'uses' => 'DiscountsController@tableDiscounts']);
            Route::get('discounts/discounts/delete/{id}', 'DiscountsController@destroy');
            Route::get('discounts/items/delete/{id}', 'ItemsController@destroy');
            //get the customers
            Route::get('discounts/data/getCustomers', ['as' => 'api.customers', 'uses' => 'CustomersController@tableCustomers']);
            Route::get('discounts/customers/delete/{id}', 'CustomersController@destroy');
            //get the operation
            Route::get('discounts/data/getOperations', ['as' => 'api.operations', 'uses' => 'OperationsController@tableOperations']);
            Route::get('discounts/operations/delete/{id}', 'OperationsController@destroy');
            //get the location
            Route::get('discounts/data/getLocations', ['as' => 'api.locations', 'uses' => 'LocationsController@tableLocations']);
            Route::get('discounts/locations/delete/{id}', 'LocationsController@destroy');
            //get the pricelists
            Route::get('discounts/data/getPricelists', ['as' => 'api.pricelists', 'uses' => 'PricelistsController@tablePricelists']);
            Route::get('discounts/pricelists/delete/{id}', 'PricelistsController@destroy');

		}
	}
});



/*
	Rest request netsuite
*/



Route::group(['prefix' => 'api/v2/discounts', 'before'=> 'auth.basic'], function(){

	Route::post('items', ['uses'=> 'ApiController@itemAdd']);
	Route::post('locations', ['uses' => 'ApiController@locationsAdd']);
	Route::post('operations', ['uses' => 'ApiController@operationsAdd']);
	Route::post('pricelists', ['uses' => 'ApiController@pricelistsAdd']);
	/*
		CUSTOMER ADD NETSUITE
		create by : rosales ian
		created at : 01-04-16
	*/
	Route::post('customers', ['uses' => 'ApiController@customersAdd']);
	Route::get('list', ['uses' => 'ApiController@discountList']);

	//post to bulk si transaction
	Route::post('si/internalId', ['uses' => 'ApiController@searchSi']);

	//get to bulk si transaction
	Route::get('si/get/amount', ['uses' => 'ApiController@getAmount']);

});







