<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// ==========================================

	require '../finch/inc/Finch.php';
	
	// Create Finch object for testing
	$optsms=new Finch('http://localhost/finch/samples/sms.php', 'APP_000001');
	$optsms->address='tel:94771122336';
	$optsms->password='password';

	// This will only show [  Test Name , SMS Sent and Real message ]
	// Not whether it is fail or not and the expected message 
	$optsms->debug=false;

	// assertmatchsms(     Test Name  , SMS sent , SMS expected in return s   )
	$optsms->assertmatchsms("First Message","hi start","This message is sent only to one user");
	$optsms->assertmatchsms("Broadcast Message","broadcast","This is a broadcast message to all the subcribers of the application");
	
	$optsms->runtests();		// Excutes all the tests

	
?>