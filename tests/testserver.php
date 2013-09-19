<?php
// ==========================================
// Finch Ideamart Apps Testing Framwork
// ==========================================
// Author : Pasindu De Silva
// Licence : MIT License
// http://opensource.org/licenses/MIT
// ==========================================

		echo '{"statusCode": "S1000","statusDetail": "Success"}';
        $array = json_decode(file_get_contents('php://input'), true);
        $json=json_encode($array);
		$f=fopen("in.txt","a");
		fwrite($f, $json."\n");
		fclose($f);
?>