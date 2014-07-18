<?php

ini_set('error_log', 'ussd-app-error.log');
require 'lib/MoUssdReceiver.php';
require 'lib/MtUssdSender.php';

	$production=false;

	if($production==false){
		$ussdserverurl ='http://localhost/finch/tests/testserver.php';
	}
	else{
		$ussdserverurl= 'https://api.dialog.lk/ussd/send';
	}

$receiver 	= new UssdReceiver();
$sender 	= new UssdSender($ussdserverurl,'APP_000001','Password');

$content 			= 	$receiver->getMessage(); // get the message content
$address 			= 	$receiver->getAddress(); // get the sender's address
$sessionId 			= 	$receiver->getSessionId(); // get the session ID;
$ussdOperation 		= 	$receiver->getUssdOperation(); // get the ussd operation


session_id($sessionId); 
session_start();
	
$mainmsg = "Welcome \nSelect your T shirt sizes\n1. Small\n2. Medium\n3. Large";

if ($ussdOperation  == "mo-init") { 
	try {
		
		$_SESSION['menu'] = 'main';
		$sender->ussd($sessionId, $mainmsg,$address );
	} catch (Exception $e) {
		$sender->ussd($sessionId, 'Sorry error occured try again',$address );
	}
	
}else {

	$flag=0;

  	$cuch_menu=$_SESSION['menu'];

		switch($cuch_menu ){
		
			case "main":
					switch ($receiver->getMessage()) {
						case "1":
							$_SESSION['menu'] = 'small';
		$sender->ussd($sessionId,  "You have select small confirm press 1",$address );
							
							break;
						case "2":
							$_SESSION['menu'] = 'medium';
		$sender->ussd($sessionId,  "You have select medium confirm press 1",$address );
							
							break;
						case "3":
							$_SESSION['menu'] = 'large';
		$sender->ussd($sessionId,  "You have select large confirm press 1",$address );
							
							break;
						default:
							$sender->ussd($sessionId,  "Incorrect Option\n".$mainmsg,$address );
							break;
					}
					break;

			case 	'small':
			case 	'medium':
			case 	'large':	
		$sender->ussd($sessionId,  "Thank you for confirming",$address );
				break;
			default:
				$_SESSION['menu'] = 'main';
				$sender->ussd($sessionId,  "Incorrect Option\n".$mainmsg,$address );
			break;
		}
}



function getada(){

}


