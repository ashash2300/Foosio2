<?php
 	require_once("Rest.inc.php");
	
	class API extends REST {
	
	$data="";

		public function __construct(){
			parent::__construct();				// Init parent contructor
		}

		private function calculateRecoveryDate(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$hours = (int)$this->_request['hours'];
			if($hours > 0){				
				$dates = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
				$day = date('w');	//actual day, you can change this parameter to test the function
				$hour = date('H'); //actual hour, you can change this parameter to test the function
				$minute = date('i');
				if($day==0 || $day==6 || $hour>=16 || $hour<10)
					{
					echo("A new injury can only be submitted during the doctor s working hours");
					}
				else
				{
					while($hours>0)
					{
						$hour++;
						if($hour>15)
						{
							$day++;
							$hour=10;
							if($day==6)
							{
								$day=1;
							}				
						}
						
						$hours--;	
					}
					echo ;
				}
				$success = array('status' => "Success", "msg" => "The recovery date will be " . $hour . ":" . $minute . " on " . $dates[$day]);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}
		
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>