<?php 
namespace Utilities;

use GuzzleHttp\Client;

use GuzzleHttp\Pool;

use GuzzleHttp\Event\ErrorEvent;

use GuzzleHttp\Event\CompleteEvent;

use Config;

class PoolRequest {

	public function __construct()
	{
		$this->uri ="/app/site/hosting/restlet.nl?script=603&deploy=1"; //netsuite
	}
	
	public function get( $data = [] )
	{
		if(empty($data))
		{
			return;
		}

		// return $this->request( 'GET',$data );

		$this->client = new Client(Config::get('netsuite.validate'));
		$requests = [];

		foreach ($data as $value) {
			$requests[] = $this->client->createRequest( 'GET', $this->uri, [
				'query' => $value
			]);

		}
		
		$response;
		Pool::send($this->client, $requests, [
		    'complete' => [
			    [
				    'fn' => function (CompleteEvent $event) use (&$response){
				        $response[] = $event->getResponse()->json();		        

				    },
				    'once' => false
			    ]
		    ],
		    'error' => [
			    [
			    	'fn' => function (ErrorEvent $event){
					    $newResponse = $event->getClient()->send($event->getRequest());
					    $event->intercept($newResponse);
		    		},
		    		'once' => false
		    	]
		    ],
		    ]);

		return $response;	
		
	}

	public function post( $data = [] )
	{
		if(empty($data))
		{
			return;
		}

		// return $this->request( 'POST',$data );


		$requests = [];

		$this->client = new Client(Config::get('netsuite.upload'));

		foreach ($data as $value) {
			
			$requests[] = $this->client->createRequest( 'POST', $this->uri, [
				'json' => $value
			]);

		}
		
		$response = [];

		Pool::send($this->client, $requests, [
		    'complete' => [
		    	[
		    		'fn' => function (CompleteEvent $event) use (&$response) {
		        			$response[] = $event->getResponse()->json();		        
		    		},
		    		'once' => false
		    	]
		    ],
		    'error' => [
		    	[
		    		'fn' => function (ErrorEvent $event){
		    			$newResponse = $event->getClient()->send($event->getRequest());
		    			$event->intercept($newResponse);
			   		},
			    	'once' => false
		    	]
		    ]
		    ]);

		// Pool::send($this->client, $requests, [
		//     'complete' => function (CompleteEvent $event) use (&$response){
		//         $response[] = $event->getResponse()->json();		        

		//     },
		//     'error' => function (ErrorEvent $event){
		// 		    $newResponse = $event->getClient()->send($event->getRequest());
		// 		    $event->intercept($newResponse);
		//     },
		//     ]);

	return $response;

	}

	// protected function request( $requestType, $data)
	// {
	// 	$requests = [];

	// 	$requestBodyType = 'json';

	// 	if($requestType == 'GET')
	// 	{
	// 		$requestBodyType = 'query';
	// 	}

	// 	foreach ($data as $value) {
			
	// 		$requests[] = $this->client->createRequest( $requestType, $this->uri, [
	// 			$requestBodyType => $value
	// 		]);

	// 	}
		
	// 	$response;
	// 	Pool::send($this->client, $requests, [
	// 	    'complete' => function (CompleteEvent $event) use (&$response){
	// 	        //var_dump('Completed request to ' . $event->getRequest()->getUrl());
	// 	        $response[] = $event->getResponse()->json();		        

	// 	    },
	// 	    'error' => function (ErrorEvent $event){
	// 	    	// if($event->getResponse()->getStatusCode()==500)
	// 	    	// {
	// 			    $newResponse = $event->getClient()->send($event->getRequest());
	// 			    $event->intercept($newResponse);
	// 	    	//}
	// 	    }]);

	// return $response;	
	// }
}