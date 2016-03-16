<?php
	$netsuite_credentials = array('secret'=>'NLAuth nlauth_account=3625074, nlauth_email='.Auth::user()->email.', nlauth_signature='.Auth::user()->netsuite_password.', nlauth_role='.Auth::user()->netsuite_role);
return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/
	'mailgun' => array(
		'domain' => '',
		'secret' => '',
	),

	'mandrill' => array(
		'secret' => '',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),
	
	'netsuite' => array(
		'secret' => $netsuite_credentials,
	),

);
