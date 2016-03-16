<?php
return [
	
	/*
	** User Credentials
	** This Credential is use when uploading the data in netsuite. 
	*/
	
	'upload'=>[
			// 'base_url'=>'https://rest.sandbox.netsuite.com/',
			'base_url'=>'https://rest.netsuite.com/',
			'defaults' => [

				'verify' => false,

				'headers' =>[

					'Authorization'=> Config::get('services.netsuite.secret'),

					'Content-Type'=>'application/json'		
				]
			]
		],
	/*
	** Administrator Credentials
	** This Credential is use when validating the data in netsuite. 
	*/

	'validate'=>[ 
			// 'base_url'=>'https://rest.sandbox.netsuite.com/',
			'base_url'=>'https://rest.netsuite.com/',
			'defaults' => [

				'verify' => false,

				'headers' =>[

					'Authorization'=> 'NLAuth nlauth_account=3625074, nlauth_email=brianestavilla@gmail.com, nlauth_signature=March21993, nlauth_role=3',

					'Content-Type'=>'application/json'		
				]
			]
		],	
	// 'invoice'=>'https://system.sandbox.netsuite.com/app/accounting/transactions/custinvc.nl?id=',//Used to view invoice in sandbox//
	// 'purchaseorder'=>'https://system.sandbox.netsuite.com/app/accounting/transactions/purchord.nl?id=',//Used to view PO in sandbox//
	// 'returnauthorization'=>'https://system.sandbox.netsuite.com/app/accounting/transactions/rtnauth.nl?id='//Used to view IRA in sandbox//

	'invoice'=>'https://system.netsuite.com/app/accounting/transactions/custinvc.nl?id=',//Used to view invoice in netsuite//
	'purchaseorder'=>'https://system.netsuite.com/app/accounting/transactions/purchord.nl?id=',//Used to view PO in netsuite//
	'returnauthorization'=>'https://system.netsuite.com/app/accounting/transactions/rtnauth.nl?id='//Used to view IRA in netsuite//
];