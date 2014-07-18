<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// ==========================================

	require '../finch/inc/Finch.php';
	
	// Setup Test Application
	$optussd=new Finch('http://localhost/finch/samples/ussd.php', 'APP_000001');
	$optussd->address='tel:94771122336';
	$optussd->password='password';
	$optussd->debug=true;

	//assertmatchussd(     Test Name  , SMS sent , SMS expected in return s   )
	$optussd->assertmatchussd("Main Menu",'000','Welcome Select your T shirt sizes1. Small2. Medium3. Large','mo-init');
	$optussd->assertmatchussd("Select small",'1','You have select small confirm press 1');
	$optussd->assertmatchussd("Confirming",'1','Thank you for confirming');
	$optussd->customTest("Test DB","Test Works","false"); 
	
	$optussd->runtests();	// Excutes all the tests
	
?>