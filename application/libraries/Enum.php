<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Enum
	{
			private $masterArray=array(
				"adminstatus"					=>	array(0=>"active",1=>"blocked"),
				"coursestatus"				=>	array(0=>"active",1=>"blocked"),
				"chapterstatus"				=>	array(0=>"active",1=>"blocked"),
				"sectionstatus"				=>	array(0=>"active",1=>"blocked"),
				"forumqstatus"				=>	array(0=>"active",1=>"blocked"),
				"categorystatus"			=>	array(0=>"active",1=>"blocked"),
				"userstatus"					=>	array(0=>"active",1=>"blocked"),
				"isemailvefied"				=>	array(0=>"Verified",1=>"Not Verified"),
				"articlestatus"				=>	array(0=>"active",1=>"blocked"),
				"pollstatus"					=>	array(0=>"active",1=>"blocked"),
				"questionstatus"			=>	array(0=>"active",1=>"blocked"),
				"isanswer"						=>	array(0=>"false",1=>"true"),
				"isread"							=>	array(0=>"false",1=>"true"),
				"tagstatus"						=>	array(0=>"active",1=>"blocked"),
			);
		function exchangeOptions($receivedArrayName, $receivedColumnName, $queryResult = false)
		{
			$masterArray=$this->masterArray;
			$receivedArrayName = strtolower(trim($receivedArrayName)); 
			if (array_key_exists($receivedArrayName, $masterArray)){
				$receivedArray = $masterArray[$receivedArrayName];
				if($queryResult != false)
				{
					foreach ($queryResult as $qr)
						$qr->$receivedColumnName = ucwords($receivedArray[$qr->$receivedColumnName]);
					return $queryResult;
				}
				else
					return array_search(strtolower(trim($receivedColumnName)), $receivedArray);
			}
		}

		//add code for BS form dropdown element with selected attribute having enums as options

		/*function exchangeOptions($receivedArrayName,$receivedValue)
		{
			$masterArray=$this->masterArray;
			$receivedArrayName = strtolower(trim($receivedArrayName)); 
			if (array_key_exists($receivedArrayName, $masterArray))
			{
				$receivedArray=$masterArray[$receivedArrayName];
				if(is_numeric($receivedValue) && $receivedValue<=count($receivedArray))
					return ucwords($receivedArray[$receivedValue]);
				elseif(is_string(trim($receivedValue)))
					return array_search(strtolower(trim($receivedValue)), $receivedArray);
			}
		}
		//code for BS form dropdown element with selected attribute having enums as options
	}*/
	}
?>