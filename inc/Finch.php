<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// http://opensource.org/licenses/MIT
// ==========================================

require "core.php";

interface ImpTesting
{
    public function newSessionId();
    public function newRequestId();
    public function jsonEncode($json);
    public function storetests($data);
    public function runtests();
}

class Finch extends Core implements ImpTesting
{
	public $serverUrl;
	public $appid;		
	public $sessionid;
	public $requestId;
	public $address;
	public $api="ussd";
	public $outSMSfile="out.txt";
	public $inSMSfile= "in.txt";
	public $results;
	public $testhost;


	function __construct($serverUrl,$appid)
	{
		$this->serverUrl=$serverUrl;
		$this->appid=$appid;
		$this->testhost="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$path = pathinfo(  $this->testhost );
		$testfile = $path['basename'];
		$this->testhost =str_replace($testfile,"results.json",$this->testhost);
		echo $this->testhost;
		file_put_contents($this->outSMSfile, "");
		file_put_contents($this->inSMSfile, "");
		$this->newSessionId();
	}

	public function newSessionId()
	{
		$this->sessionid="".rand(5, 99999999999)."";
	}

	public function newRequestId()
	{
		$this->requestId="".rand(5, 150000)."";
	}

	public function jsonEncode($json)
	{
		return json_encode($json);
	}

	public function storetests($data){
		$f=fopen($this->outSMSfile,"a");
		fwrite($f, $data."\n");
		fclose($f);
	}
}




?>