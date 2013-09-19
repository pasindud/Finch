<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// http://opensource.org/licenses/MIT
// ==========================================

/**
* Tests Implementations
*/
class testImp 
{
	public function assertmatch_test($jout,$jin)
	{
			$str = str_replace(array("\r\n", "\n", "\r"), ' ', $jin['message']);

			if ($jout['expect']==$str) {
			 	return  "true";
			}else{
				return  " Fails : expect -: ".$jout['expect']." real -: ".$str;
			}
	}

	public function assertmatchussd($testname,$message,$expect,$ussd_operation='mo-cont'){
		$data=$this->makerequest_ussd($message,$ussd_operation);
		$data=array_merge($data,array("expect"=>$expect,"type"=>"assertmatch","api"=>'ussd',"testname"=>$testname));
		$this->storetests($this->jsonEncode($data));
	}

	public function assertmatchsms($testname,$message,$expect){
		$data=$this->makerequest_sms($message);
		$data=array_merge($data,array("expect"=>$expect,"type"=>"assertmatch","api"=>'sms',"testname"=>$testname));
		$this->storetests($this->jsonEncode($data));
	}	
	
	public function customTest($testname,$message,$status){
		$data=array("status"=>$status,"message"=>$message,"type"=>"customTest","api"=>'custom',"testname"=>$testname);
		$this->storetests($this->jsonEncode($data));
	}
}

?>