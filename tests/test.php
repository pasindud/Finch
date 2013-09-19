<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// ==========================================

	require '../inc/Finch.php';
	
	// Create Finch object for testing
	$optsms=new Finch('../sample/listener.php', 'APP_000001');
	$optsms->address='tel:94771122336';
	
	$optsms->assertmatchsms("First Message","hi start","This message is sent only to one user");
	$optsms->assertmatchsms("Broadcast Message","broadcast","This is a broadcast message to all the subcribers of the application");
	
	$optsms->runtests();		// Excutes all the tests
	
	
	/* 	Ussd tests
	
		$optussd=new Finch('http://localhost/dialog/ussdapp.php', 'APP_000001');
		$optussd->address='tel:94771122336';
		$optussd->assertmatchussd("Main Menu",'123','1. Donation 2. Champion 3. Register  99. Exit','mo-init');
		$optussd->customTest("Test DB","Test Works","false"); 
	
	*/
?>