<?php

	class call_api extends api {
		
		private $device_uuid;
		private $user_id;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];

		}

		public function get_response () {
						
			if (($this->user_id = $this->get_user_id()) == TRUE) {
				
				$data = array ('1', $this->generate_list()); // define success response

			} else {

				$data = array ('0', 'Unknown Device UUID'); // device does not exist. if no, define fail response.

			}

			return $this -> response ($data);

		}
		
		private function get_user_id () { // get from chris what a valid promo code looks like.
			GLOBAL $mysqli;
			list ($result) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `user_id` FROM `user_device` WHERE `device_uuid` = '" . $this->device_uuid . "' LIMIT 1"));
			return $result;
		}

		private function generate_list () { // get from chris what a valid promo code looks like.
			GLOBAL $mysqli;
			$result = array (); // create empty list array
			$r = mysqli_query ($mysqli, "SELECT `issue_id` FROM `user_issue` WHERE `user_id` = '" . $this->user_id . "' ORDER BY `issue_id` ASC");
			while ($row = mysqli_fetch_assoc ($r)) {
				$result[] = $row['issue_id']; // add to list array
			}
			mysqli_free_result ($r);
			return implode (',', $result); // return imploded list as csv
		}

	}

?>