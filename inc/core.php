<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// http://opensource.org/licenses/MIT
// ==========================================

require "tests.php";

class Core extends testImp
{
	/*
	* Excutes  the tests
	*/
	public function runtests()
	{

		$out = fopen($this->outSMSfile,"r");
		$in = fopen($this->inSMSfile,"r");
		$i=0;
		$passes=0;
		$fails=0;
		$results='';

		while(! feof($out)){

			$i++;

			$jout= json_decode(fgets($out), true) ;

			if ("customTest"==$jout['type']) {

					if ($jout['status']==true) {
						$status="100";
					}else{
						$status="0";
					}

				 	$results[$i-1]=array('name' =>
										array('testid' =>$i ,
										'tests'=>$jout['testname'],
										'expect'=>$jout['message'],
										'real'=>"........",
										'status'=>$status
									));  

		
			}else{
			
				if(! feof($in)){
			  	
				  	$jin= json_decode(fgets($in), true) ;

					try {
						$type=$jout['type']."_test";

						if ($jout['type']=="") {
							break;
						}

						$status=parent::$type($jout,$jin);
					} catch (Exception $e) {
						throw new Exception("Test type not available", 1);
						
					}

					if ($status=="true") {
						//echo "\nTest ".$i."- Passes <br>";
						$passes++;
						$status="100";
					}else{
						$fails++;
						//echo "\nTest ".$i."- ".$status."<br>";
						$status="0";
					}

					$results[$i-1]=array('name' =>
										array('testid' =>$i ,
										'tests'=>$jout['testname'],
										'expect'=>$jout['expect'],
										'real'=>$jin['message'],
										'status'=>$status
									));  
		
			  	}
			}
		}
		$results= array_merge( array( "tests"=>$results) , array("passes"=>$passes,"fails"=>$fails ));   

		file_put_contents("results.json", json_encode($results));
		fclose($out);
		fclose($in);
	}

	public function sendRequest($jsonStream){
		$ch = curl_init($this->serverUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStream);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
	}

	public function makerequest_sms($message)
	{		
			$this->newRequestId();
			$data=array(
				"message"=>$message,
				"sourceAddress"=>$this->address,
				"requestId"=>$this->requestId,
				"encoding"=>"0",
				"version"=>"1.0"
			);

			$this->sendRequest($this->jsonEncode($data));
			return $data;
	}

	public function makerequest_ussd($message,$ussd_operation)
	{
			$this->newRequestId();
			$data=array(
				'sourceAddress'=>$this->address,
		        'message'=>$message,
		       	'requestId'=>$this->requestId,
		        'applicationId'=>$this->appid,
		        'encoding'=>'440',
		   		'version'=>'2',
		      	'sessionId'=>$this->sessionid,
		        'ussdOperation'=>$ussd_operation
			);

			$this->sendRequest($this->jsonEncode($data));
			return $data;
	}

}

?>